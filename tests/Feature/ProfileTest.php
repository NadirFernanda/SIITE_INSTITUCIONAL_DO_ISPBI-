<?php

use App\Models\Alumnus;
use App\Models\User;

function alumniProfile(User $user): Alumnus
{
    return Alumnus::create([
        'user_id' => $user->id, 'nome' => 'Alumni Teste', 'curso' => 'Informática',
        'ano' => 2025, 'contacto' => '900000000', 'trabalha' => false, 'publicado' => false,
    ]);
}

test('profile page is displayed', function () {
    $user = securityUser('alumni');
    alumniProfile($user);

    $response = $this
        ->actingAs($user)
        ->get(route('portal.perfil'));

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = securityUser('alumni');
    $alumnus = alumniProfile($user);
    $other = alumniProfile(securityUser('alumni'));
    $originalEmail = $user->email;

    $response = $this
        ->actingAs($user)
        ->put(route('portal.perfil.update'), [
            'contacto' => '923456789', 'trabalha' => 'sim', 'empresa' => 'Empresa Teste',
            'cargo' => 'Engenheiro', 'pais' => 'Angola', 'satisfacao' => 'Testemunho teste',
            'user_id' => $other->user_id, 'role' => 'admin', 'aprovado' => false,
            'name' => 'Nome adulterado', 'email' => 'alterado@example.test',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('portal.perfil'));

    $user->refresh();

    expect($alumnus->fresh()->contacto)->toBe('923456789');
    expect($alumnus->fresh()->empresa)->toBe('Empresa Teste');
    expect($alumnus->fresh()->trabalha)->toBeTrue();
    expect($other->fresh()->contacto)->toBe('900000000');
    expect($user->email)->toBe($originalEmail);
    expect($user->role)->toBe('alumni');
    expect($user->aprovado)->toBeTrue();
    expect($user->name)->not->toBe('Nome adulterado');
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = securityUser('alumni');
    alumniProfile($user);
    $verifiedAt = $user->email_verified_at->toISOString();

    $response = $this
        ->actingAs($user)
        ->put(route('portal.perfil.update'), [
            'contacto' => '900000000', 'trabalha' => 'nao',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('portal.perfil'));

    $this->assertNotNull($user->refresh()->email_verified_at);
    expect($user->email_verified_at->toISOString())->toBe($verifiedAt);
});

test('self service account deletion remains unavailable even with the correct password', function () {
    $user = securityUser('alumni');
    $alumnus = alumniProfile($user);

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response->assertNotFound();
    $this->delete(route('portal.perfil'), ['password' => 'password'])->assertStatus(405);

    $this->assertAuthenticatedAs($user);
    $this->assertNotNull($user->fresh());
    $this->assertNotNull($alumnus->fresh());
});

test('an incorrect password cannot delete an account through disabled endpoints', function () {
    $user = securityUser('alumni');
    $alumnus = alumniProfile($user);

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
        ]);

    $response->assertNotFound();
    $this->delete(route('portal.perfil'), ['password' => 'wrong-password'])->assertStatus(405);

    $this->assertNotNull($user->fresh());
    $this->assertNotNull($alumnus->fresh());
    $this->assertAuthenticatedAs($user);
});

test('profile updates validate input without changing any profile', function () {
    $user = securityUser('alumni');
    $alumnus = alumniProfile($user);
    $this->actingAs($user)->from(route('portal.perfil'))
        ->put(route('portal.perfil.update'), ['trabalha' => 'invalido', 'contacto' => str_repeat('9', 51)])
        ->assertRedirect(route('portal.perfil'))->assertSessionHasErrors(['trabalha', 'contacto']);
    expect($alumnus->fresh()->contacto)->toBe('900000000');
});

test('profile routes require authentication approval and alumni role', function () {
    $url = route('portal.perfil');
    $this->get($url)->assertRedirect(route('login'));
    $this->actingAs(securityUser('alumni', false))->get($url)->assertRedirect(route('portal.pendente'));
    $this->actingAs(securityUser('tecnico'))->get($url)->assertRedirect(route('portal.login'));
});
