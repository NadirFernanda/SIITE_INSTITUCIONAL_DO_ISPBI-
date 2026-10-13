<?php

use App\Models\Candidatura;
use App\Models\User;
use App\Services\WhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;

test('unsigned visitors cannot access the receipt or pdf', function () {
    $candidate = securityCandidate();
    $this->get(route('candidaturas.comprovativo', $candidate))->assertForbidden();
    $this->get(route('candidaturas.pdf', $candidate))->assertForbidden();
    expect($candidate->fresh()->comprovativo_gerado_em)->toBeNull();
});

test('signed receipts preserve the candidate download flow', function () {
    $candidate = securityCandidate();
    $url = URL::temporarySignedRoute('candidaturas.comprovativo', now()->addHour(), ['candidatura' => $candidate->id]);
    $response = $this->get($url)->assertOk()->assertSee('Candidato Teste');
    expect($response->headers->hasCacheControlDirective('private'))->toBeTrue();
    expect($response->headers->hasCacheControlDirective('no-store'))->toBeTrue();
    mockComprovativoPdf();
    $pdfUrl = URL::temporarySignedRoute('candidaturas.pdf', now()->addHour(), ['candidatura' => $candidate->id]);
    $this->get($pdfUrl)->assertOk()->assertHeader('Content-Type', 'application/pdf');
    expect($candidate->fresh()->comprovativo_gerado_em)->not->toBeNull();
});

test('expired altered or reused signatures are rejected', function () {
    $candidate = securityCandidate();
    $other = securityCandidate();
    foreach (['candidaturas.pdf', 'candidaturas.comprovativo'] as $route) {
        $expired = URL::temporarySignedRoute($route, now()->subMinute(), ['candidatura' => $candidate->id]);
        $valid = URL::temporarySignedRoute($route, now()->addHour(), ['candidatura' => $candidate->id]);
        $this->get($expired)->assertForbidden();
        $this->get($valid.'&altered=1')->assertForbidden();
        $this->get(str_replace('/'.$candidate->id.'/', '/'.$other->id.'/', $valid))->assertForbidden();
    }
});

test('authentication without an authorized role never grants pdf access', function (string $role) {
    $candidate = securityCandidate();
    $this->actingAs(securityUser($role))->get(route('candidaturas.pdf', $candidate))->assertForbidden();
    expect($candidate->fresh()->comprovativo_gerado_em)->toBeNull();
})->with(['alumni', 'secretaria', 'presidencia', 'professor', 'lancamento', 'superadmin', 'admin auxiliar']);

test('authorized internal roles can download and record receipt generation', function (string $role) {
    $candidate = securityCandidate();
    mockComprovativoPdf();
    $user = securityUser($role);
    $this->actingAs($user)->get(route('candidaturas.pdf', $candidate))->assertOk();
    expect($candidate->fresh()->comprovativo_gerado_por)->toBe($user->id);
})->with(['admin', 'daac', 'tecnico']);

test('unauthorized users cannot download receipts through internal endpoints', function (string $prefix) {
    $candidate = securityCandidate();
    $this->actingAs(securityUser('alumni'))
        ->get(route($prefix.'.candidaturas.comprovativo', $candidate))
        ->assertRedirect(route('login'));
    expect($candidate->fresh()->comprovativo_gerado_em)->toBeNull();
})->with(['admin', 'daac', 'tecnico']);

test('internal receipt routes enforce authorization', function (string $prefix) {
    $candidate = securityCandidate();
    $candidate->forceFill(['assinado_em' => now()])->save();
    mockComprovativoPdf();
    $this->actingAs(securityUser($prefix))->get(route($prefix.'.candidaturas.comprovativo', $candidate))->assertOk();
})->with(['admin', 'daac', 'tecnico']);
