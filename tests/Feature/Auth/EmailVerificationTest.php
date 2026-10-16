<?php

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

test('email verification screen can be rendered', function () {
    $user = securityUser('admin');
    $user->forceFill(['email_verified_at' => null])->save();

    $response = $this->actingAs($user)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    $user = securityUser('admin');
    $user->forceFill(['email_verified_at' => null])->save();

    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1($user->email)]
    );

    $response = $this->actingAs($user)->get($verificationUrl);

    Event::assertDispatched(Verified::class);
    expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('admin', absolute: false).'?verified=1');
});

test('email is not verified with invalid hash', function () {
    $user = User::factory()->unverified()->create();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $user->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($user)->get($verificationUrl)->assertForbidden();

    expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('already verified users return to their own portal without following a foreign intended URL', function (bool $approved, string $destination) {
    $user = securityUser('alumni', $approved);
    $this->actingAs($user)->withSession(['url.intended' => '/admin'])
        ->get(route('verification.notice'))->assertRedirect(route($destination, absolute: false));
    $this->post(route('verification.send'))->assertRedirect(route($destination, absolute: false));
    $signed = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
        'id' => $user->id, 'hash' => sha1($user->email),
    ]);
    $this->get($signed)->assertRedirect(route($destination, absolute: false).'?verified=1');
})->with([[true, 'portal.dashboard'], [false, 'portal.pendente']]);

test('an email verification signature cannot be used by another account', function () {
    $owner = User::factory()->unverified()->create();
    $other = securityUser('admin');
    $signed = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
        'id' => $owner->id, 'hash' => sha1($owner->email),
    ]);
    $this->actingAs($other)->get($signed)->assertForbidden();
    expect($owner->fresh()->hasVerifiedEmail())->toBeFalse();
});
