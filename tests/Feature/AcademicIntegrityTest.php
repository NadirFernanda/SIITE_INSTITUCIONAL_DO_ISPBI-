<?php

use App\Models\Candidatura;
use App\Models\CandidaturaNota;
use App\Models\CourseDiscipline;
use App\Models\CursoVaga;
use App\Models\Sala;
use App\Models\SalaDiscipline;
use App\Services\AdmissaoService;
use App\Services\DistribuicaoSalasService;
use App\Services\NotaDisciplinaService;
use App\Services\SalaAtribuicaoService;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Tests\Support\AcademicFixtures;

it('recalcula a nota final ao alterar a configuração de disciplinas sem eliminar notas históricas', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 60, 'Português' => 40]);
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Matemática', 'nota' => 8]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Português', 'nota' => 5]);
    $candidatura->update(['nota_exame' => 13]);

    app(NotaDisciplinaService::class)->actualizarDisciplinas($sala, [
        ['discipline' => 'Matemática', 'weight' => 50],
        ['discipline' => 'Português', 'weight' => 30],
        ['discipline' => 'História', 'weight' => 20],
    ]);

    expect($candidatura->fresh()->nota_exame)->toBeNull()
        ->and(CandidaturaNota::where('candidatura_id', $candidatura->id)->count())->toBe(2);
});

it('limpa a nota final quando se elimina uma disciplina que contribuía para a nota', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 60, 'Português' => 40]);
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Matemática', 'nota' => 8]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Português', 'nota' => 7]);
    $candidatura->update(['nota_exame' => 15]);

    app(NotaDisciplinaService::class)->actualizarDisciplinas($sala, [
        ['discipline' => 'Matemática', 'weight' => 100],
    ]);

    expect($candidatura->fresh()->nota_exame)->toBe(8.0)
        ->and(CandidaturaNota::where('candidatura_id', $candidatura->id)->where('discipline', 'Português')->exists())->toBeTrue();
});

it('recusa uma configuração cujo peso não totalize cem por cento e conserva a configuração anterior', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 60, 'Português' => 40]);

    expect(fn () => app(NotaDisciplinaService::class)->actualizarDisciplinas($sala, [
        ['discipline' => 'Matemática', 'weight' => 60],
        ['discipline' => 'Português', 'weight' => 30],
    ]))->toThrow(ValidationException::class);

    expect(SalaDiscipline::where('sala_id', $sala->id)->sum('weight_percent'))->toBe(100);
});

it('recusa reduzir o peso abaixo de notas já lançadas e não altera a configuração', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 60, 'Português' => 40]);
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Matemática', 'nota' => 10]);

    expect(fn () => app(NotaDisciplinaService::class)->actualizarDisciplinas($sala, [
        ['discipline' => 'Matemática', 'weight' => 40],
        ['discipline' => 'Português', 'weight' => 60],
    ]))->toThrow(ValidationException::class);

    expect(SalaDiscipline::where('sala_id', $sala->id)->where('discipline', 'Matemática')->value('weight_percent'))->toBe(60);
});

it('recusa notas para disciplinas não configuradas e mantém os dados sem escrita parcial', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 100]);
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);

    expect(fn () => app(NotaDisciplinaService::class)->lancarNotas(
        $candidatura,
        ['Matemática' => 10, 'Disciplina Inexistente' => 9]
    ))->toThrow(ValidationException::class);

    expect(CandidaturaNota::where('candidatura_id', $candidatura->id)->count())->toBe(0)
        ->and($candidatura->fresh()->nota_exame)->toBeNull();
});

it('impede duplicados de notas e disciplinas ao nível da base de dados', function () {
    $sala = AcademicFixtures::sala();
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);
    CandidaturaNota::create(['candidatura_id' => $candidatura->id, 'discipline' => 'Matemática', 'nota' => 10]);
    SalaDiscipline::create(['sala_id' => $sala->id, 'discipline' => 'Matemática', 'weight_percent' => 100]);

    expect(fn () => DB::transaction(fn () => CandidaturaNota::create([
        'candidatura_id' => $candidatura->id,
        'discipline' => 'Matemática',
        'nota' => 11,
    ])))->toThrow(QueryException::class);

    expect(fn () => DB::transaction(fn () => SalaDiscipline::create([
        'sala_id' => $sala->id,
        'discipline' => 'Matemática',
        'weight_percent' => 100,
    ])))->toThrow(QueryException::class);
});

it('só grava uma nota por candidatura e disciplina, recalculando a soma quando completa', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::disciplinas($sala, ['Matemática' => 60, 'Português' => 40]);
    $candidatura = AcademicFixtures::candidatura(['sala_id' => $sala->id]);
    $service = app(NotaDisciplinaService::class);

    expect($service->lancarNotas($candidatura, ['Matemática' => 8]))->toBeNull();
    expect($service->lancarNotas($candidatura, ['Matemática' => 9, 'Português' => 7]))->toBe(16.0);
    expect(CandidaturaNota::where('candidatura_id', $candidatura->id)->where('discipline', 'Matemática')->count())->toBe(1)
        ->and($candidatura->fresh()->nota_exame)->toBe(16.0);
});

it('admite todos os candidatos empatados na nota de corte e não excede vagas sem empate', function () {
    CursoVaga::create(['curso' => 'Comunicação Social', 'periodo' => 'regular', 'vagas' => 2]);
    $primeiro = AcademicFixtures::candidatura(['nota_exame' => 15]);
    $empateA = AcademicFixtures::candidatura(['nota_exame' => 10]);
    $empateB = AcademicFixtures::candidatura(['nota_exame' => 10]);
    $fora = AcademicFixtures::candidatura(['nota_exame' => 9]);

    app(AdmissaoService::class)->calcular('Comunicação Social', 'regular');

    expect($primeiro->fresh()->resultado_admissao)->toBe('admitido')
        ->and($empateA->fresh()->resultado_admissao)->toBe('admitido')
        ->and($empateB->fresh()->resultado_admissao)->toBe('admitido')
        ->and($fora->fresh()->resultado_admissao)->toBe('nao_admitido')
        ->and(Candidatura::where('curso', 'Comunicação Social')->where('periodo', 'regular')->where('resultado_admissao', 'admitido')->count())->toBe(3);
});

it('reserva lugares especiais dentro da capacidade e devolve quota não usada à lista geral', function () {
    CursoVaga::create(['curso' => 'Comunicação Social', 'periodo' => 'regular', 'vagas' => 34]);
    $especial = AcademicFixtures::candidatura([
        'nota_exame' => 17,
        'necessidade_especial' => 'Filhos de antigos combatentes',
    ]);
    $gerais = collect(range(1, 34))->map(fn ($nota) => AcademicFixtures::candidatura([
        'nota_exame' => 20 - ($nota / 10),
    ]));

    app(AdmissaoService::class)->calcular('Comunicação Social', 'regular');

    expect($especial->fresh()->resultado_admissao)->toBe('admitido')
        ->and($gerais->filter(fn ($c) => $c->fresh()->resultado_admissao === 'admitido')->count())->toBe(33)
        ->and(Candidatura::where('curso', 'Comunicação Social')->where('periodo', 'regular')->where('resultado_admissao', 'admitido')->count())->toBe(34);
});

it('invalida resultados do grupo após alterações de nota, pagamento ou capacidade de vagas', function () {
    CursoVaga::create(['curso' => 'Comunicação Social', 'periodo' => 'regular', 'vagas' => 1]);
    $candidatura = AcademicFixtures::candidatura([
        'nota_exame' => 15,
        'resultado_admissao' => 'admitido',
        'resultado_calculado_em' => now(),
    ]);
    $colega = AcademicFixtures::candidatura([
        'nota_exame' => 12,
        'resultado_admissao' => 'nao_admitido',
        'resultado_calculado_em' => now(),
    ]);

    $candidatura->update(['nota_exame' => 14]);
    expect($colega->fresh()->resultado_admissao)->toBeNull();

    $candidatura->update(['resultado_admissao' => 'admitido', 'resultado_calculado_em' => now()]);
    $colega->update(['resultado_admissao' => 'nao_admitido', 'resultado_calculado_em' => now()]);
    $candidatura->update(['pagamento_confirmado' => false]);
    expect($colega->fresh()->resultado_admissao)->toBeNull();

    $candidatura->update(['pagamento_confirmado' => true, 'resultado_admissao' => 'admitido', 'resultado_calculado_em' => now()]);
    $colega->update(['resultado_admissao' => 'nao_admitido', 'resultado_calculado_em' => now()]);
    CursoVaga::where('curso', 'Comunicação Social')->where('periodo', 'regular')->first()->update(['vagas' => 2]);

    expect($candidatura->fresh()->resultado_admissao)->toBeNull()
        ->and($colega->fresh()->resultado_admissao)->toBeNull();
});

it('atribui lugares livres sem duplicação, bloqueia candidaturas sem pagamento e mantém histórico', function () {
    $sala = AcademicFixtures::sala(['capacidade' => 2]);
    $primeira = AcademicFixtures::candidatura(['pagamento_confirmado' => true]);
    $segunda = AcademicFixtures::candidatura(['pagamento_confirmado' => true]);
    $semPagamento = AcademicFixtures::candidatura(['pagamento_confirmado' => false]);
    $rejeitada = AcademicFixtures::candidatura(['status' => 'rejeitada']);
    $service = app(SalaAtribuicaoService::class);

    expect($service->atribuirManual($primeira, $sala))->toBe(1)
        ->and($service->atribuirManual($segunda, $sala))->toBe(2);
    expect(fn () => $service->atribuirManual($semPagamento, $sala))->toThrow(ValidationException::class);
    expect(fn () => $service->atribuirManual($rejeitada, $sala))->toThrow(ValidationException::class);
    expect($service->atribuirManual($primeira, $sala))->toBe(1);
    expect(DB::table('sala_atribuicoes_historico')->where('candidatura_id', $primeira->id)->count())->toBe(1);
});

it('preserva a atribuição manual excepcional além da capacidade sem repetir o lugar', function () {
    $sala = AcademicFixtures::sala(['capacidade' => 1]);
    $primeira = AcademicFixtures::candidatura();
    $excepcional = AcademicFixtures::candidatura();
    $service = app(SalaAtribuicaoService::class);

    expect($service->atribuirManual($primeira, $sala))->toBe(1)
        ->and($service->atribuirManual($excepcional, $sala))->toBe(2)
        ->and($primeira->fresh()->numero_lugar)->toBe(1)
        ->and($excepcional->fresh()->numero_lugar)->toBe(2);
});

it('remove a atribuição e regista o histórico quando o pagamento é cancelado ou a candidatura rejeitada', function () {
    $sala = AcademicFixtures::sala(['capacidade' => 2]);
    $pagamentoCancelado = AcademicFixtures::candidatura(['pagamento_confirmado' => true]);
    $rejeitada = AcademicFixtures::candidatura(['pagamento_confirmado' => true]);
    $service = app(SalaAtribuicaoService::class);
    $service->atribuirManual($pagamentoCancelado, $sala);
    $service->atribuirManual($rejeitada, $sala);

    $pagamentoCancelado->update(['pagamento_confirmado' => false]);
    $rejeitada->update(['status' => 'rejeitada']);

    expect($pagamentoCancelado->fresh()->sala_id)->toBeNull()
        ->and($rejeitada->fresh()->sala_id)->toBeNull()
        ->and(DB::table('sala_atribuicoes_historico')->whereIn('candidatura_id', [$pagamentoCancelado->id, $rejeitada->id])->where('evento', 'desatribuicao')->count())->toBe(2);
});

it('preserva atribuições existentes e ignora candidatos sem pagamento numa nova distribuição', function () {
    AcademicFixtures::sala(['nome' => 'Modelo A', 'capacidade' => 10]);
    $salaExistente = AcademicFixtures::sala([
        'nome' => 'Sala 1',
        'capacidade' => 10,
        'data_exame' => '2026-09-02',
        'horario' => '08:00-10:00',
    ]);
    $existente = AcademicFixtures::candidatura([
        'sala_id' => $salaExistente->id,
        'numero_lugar' => 1,
        'pagamento_confirmado' => true,
    ]);
    $nova = AcademicFixtures::candidatura(['pagamento_confirmado' => true]);
    $naoPago = AcademicFixtures::candidatura(['pagamento_confirmado' => false]);

    app(DistribuicaoSalasService::class)->distribuir();

    expect($existente->fresh()->sala_id)->toBe($salaExistente->id)
        ->and($existente->fresh()->numero_lugar)->toBe(1)
        ->and($nova->fresh()->sala_id)->not->toBeNull()
        ->and($naoPago->fresh()->sala_id)->toBeNull()
        ->and(Sala::where('data_exame', '2026-09-02')->where('horario', '08:00-10:00')->count())->toBe(1);
});

it('cancela a distribuição se a configuração de pesos do curso não totalizar cem por cento', function () {
    AcademicFixtures::sala(['nome' => 'Modelo Enfermagem', 'capacidade' => 10]);
    CourseDiscipline::create(['course_name' => 'Curso de Enfermagem', 'discipline' => 'Biologia', 'weight_percent' => 60]);
    CourseDiscipline::create(['course_name' => 'Curso de Enfermagem', 'discipline' => 'Química', 'weight_percent' => 20]);
    $candidatura = AcademicFixtures::candidatura([
        'curso' => 'Enfermagem',
        'periodo' => 'regular',
        'pagamento_confirmado' => true,
    ]);

    expect(fn () => app(DistribuicaoSalasService::class)->distribuir())->toThrow(RuntimeException::class);
    expect($candidatura->fresh()->sala_id)->toBeNull()
        ->and(Sala::whereNotNull('data_exame')->count())->toBe(0);
});

it('recusa que a base de dados aceite dois lugares iguais na mesma sala', function () {
    $sala = AcademicFixtures::sala();
    AcademicFixtures::candidatura(['sala_id' => $sala->id, 'numero_lugar' => 1]);
    $segunda = AcademicFixtures::candidatura();

    expect(fn () => DB::transaction(fn () => DB::table('candidaturas')->where('id', $segunda->id)->update([
        'sala_id' => $sala->id,
        'numero_lugar' => 1,
    ])))->toThrow(QueryException::class);
});
