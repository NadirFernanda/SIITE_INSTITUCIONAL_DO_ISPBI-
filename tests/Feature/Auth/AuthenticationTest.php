<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function (string $role, string $destination, bool $approved) {
    $user = securityUser($role, $approved);

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route($destination, absolute: false));
})->with([
    ['admin', 'admin', true], ['daac', 'daac.candidaturas.index', true],
    ['tecnico', 'tecnico.candidaturas.index', true], ['lancamento', 'lancamento.salas.index', true],
    ['professor', 'professor.candidaturas.index', true], ['secretaria', 'secretaria.candidaturas.index', true],
    ['presidencia', 'presidencia.salas.index', true], ['alumni', 'portal.dashboard', true],
    ['alumni', 'portal.pendente', false],
]);

test('users can not authenticate with invalid password', function () {
    $user = securityUser('admin');

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect(route('login'));
});

test('valid credentials with an unrecognized role do not grant a session', function () {
    $user = securityUser('user');
    $this->post('/login', ['email' => $user->email, 'password' => 'password'])->assertSessionHasErrors('email');
    $this->assertGuest();
});
