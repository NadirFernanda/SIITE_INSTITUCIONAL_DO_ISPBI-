<?php

use App\Models\Candidatura;
use App\Models\User;
use App\Services\WhatsAppService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;

function securityCandidate(): Candidatura
{
    return Candidatura::create([
        'nome' => 'Candidato Teste', 'email' => 'candidato@example.test',
        'telefone' => '900000000', 'bi' => fake()->unique()->numerify('#########LA###'),
        'curso' => 'Engenharia Informática', 'periodo' => 'regular',
    ]);
}

function securityUser(string $role, bool $approved = true): User
{
    $user = User::factory()->create();
    $user->forceFill(['role' => $role, 'aprovado' => $approved])->save();

    return $user;
}

function mockComprovativoPdf(): void
{
    $pdf = Mockery::mock(\Barryvdh\DomPDF\PDF::class);
    $pdf->shouldReceive('setPaper')->with('a4', 'portrait')->andReturnSelf();
    $pdf->shouldReceive('download')->andReturn(response('%PDF-test', 200, ['Content-Type' => 'application/pdf']));
    Pdf::shouldReceive('loadView')->with('pdf.comprovativo', Mockery::type('array'))->andReturn($pdf);
    test()->mock(WhatsAppService::class, function ($mock) {
        $mock->shouldReceive('enviarComprovativo')->andReturn(true);
    });
}

