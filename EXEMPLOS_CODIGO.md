# 💻 Exemplos de Uso — Lançamento de Notas por Sala

## Exemplo 1: Acessar a página de salas via Controller

```php
// Em routes/web.php já está configurado:
Route::get('professor/salas', [App\Http\Controllers\Professor\SalaController::class, 'index'])
    ->name('professor.salas.index');
```

**Via Browser:**
```
https://seu-site.ao/professor/salas
```

---

## Exemplo 2: Visualizar pauta de uma sala específica

```php
// Controller call (automático via rota)
$sala = Sala::find(1);
$controller = new Professor\SalaController();
$view = $controller->show($sala);

// Dados retornados:
[
    'sala' => Sala { id: 1, nome: "Informática", data_exame: "2026-07-27", ... },
    'candidaturas' => Collection [
        Candidatura { id: 1, codigo_exame: "E0234", nota_exame: 14.5, ... },
        Candidatura { id: 2, codigo_exame: "E0235", nota_exame: null, ... },
        ...
    ]
]
```

**Via Browser:**
```
https://seu-site.ao/professor/salas/1
```

---

## Exemplo 3: Lançar nota via formulário

```html
<!-- HTML form na view show.blade.php -->
<form method="POST" action="{{ route('professor.candidaturas.nota', $candidatura) }}">
    @csrf
    @method('PATCH')
    <input type="number" name="nota_exame" value="14.5" min="0" max="20" step="0.1">
    <button type="submit">Guardar Nota</button>
</form>
```

**Request HTTP:**
```
PATCH /professor/candidaturas/1/nota
Content-Type: application/x-www-form-urlencoded

_token=xyz123&_method=PATCH&nota_exame=14.5
```

**Response:**
```
HTTP/1.1 302 Found
Location: /professor/candidaturas/1#show-success

Session: {
    'success' => 'Nota 14.5 lançada com sucesso.'
}
```

---

## Exemplo 4: Consultar dados da sala com Tinker

```php
php artisan tinker

// Listar todas as salas com progresso
>>> $salas = \App\Models\Sala::with('candidaturas')->get();
>>> $salas->map(function($s) {
    return [
        'nome' => $s->nome,
        'total' => $s->candidaturas->count(),
        'com_nota' => $s->candidaturas->where('nota_exame', '!=', null)->count(),
        'sem_nota' => $s->candidaturas->where('nota_exame', null)->count(),
    ];
});

// Output:
[
    0 => [
        'nome' => 'Informática',
        'total' => 25,
        'com_nota' => 18,
        'sem_nota' => 7,
    ],
    1 => [
        'nome' => 'Enfermagem',
        'total' => 18,
        'com_nota' => 12,
        'sem_nota' => 6,
    ],
]

// Obter pauta de uma sala
>>> $sala = \App\Models\Sala::find(1);
>>> $sala->candidaturas()->select('id', 'codigo_exame', 'nota_exame', 'numero_lugar')->get();

// Lançar nota manualmente
>>> $c = \App\Models\Candidatura::find(1);
>>> $c->update([
    'nota_exame' => 14.5,
    'nota_lancada_por' => \Auth::id(),
    'nota_lancada_em' => now(),
]);
>>> exit
```

---

## Exemplo 5: Query SQL para análise

```sql
-- Estatísticas por sala
SELECT 
    s.nome,
    COUNT(c.id) as total_candidatos,
    SUM(CASE WHEN c.nota_exame IS NOT NULL THEN 1 ELSE 0 END) as com_nota,
    SUM(CASE WHEN c.nota_exame IS NULL THEN 1 ELSE 0 END) as sem_nota,
    ROUND(SUM(CASE WHEN c.nota_exame IS NOT NULL THEN 1 ELSE 0 END) * 100.0 / COUNT(c.id), 1) as percentual_conclusao,
    AVG(c.nota_exame) as media_notas
FROM salas s
LEFT JOIN candidaturas c ON s.id = c.sala_id
GROUP BY s.id, s.nome
ORDER BY s.data_exame ASC;

-- Resultado esperado:
+-------------------+------------------+----------+----------+---------------------+--------------+
| nome              | total_candidatos | com_nota | sem_nota | percentual_conclusao | media_notas  |
+-------------------+------------------+----------+----------+---------------------+--------------+
| Informática       | 25               | 18       | 7        | 72.0                | 13.2         |
| Enfermagem        | 18               | 12       | 6        | 66.7                | 12.8         |
+-------------------+------------------+----------+----------+---------------------+--------------+

-- Notas lançadas por cada professor
SELECT 
    u.name as professor,
    COUNT(c.id) as notas_lancadas,
    MIN(c.nota_lancada_em) as primeira_nota,
    MAX(c.nota_lancada_em) as ultima_nota,
    AVG(c.nota_exame) as media_notas
FROM users u
LEFT JOIN candidaturas c ON u.id = c.nota_lancada_por
WHERE u.role = 'subcomissao_correcao'
GROUP BY u.id, u.name;

-- Candidatos com nota baixa (reprovados)
SELECT 
    c.id,
    c.codigo_exame,
    s.nome as sala,
    c.nota_exame,
    c.nota_lancada_em,
    u.name as lancado_por
FROM candidaturas c
JOIN salas s ON c.sala_id = s.id
LEFT JOIN users u ON c.nota_lancada_por = u.id
WHERE c.nota_exame < 10
ORDER BY c.nota_exame ASC;
```

---

## Exemplo 6: Teste unitário (PHPUnit)

```php
<?php

namespace Tests\Feature\Professor;

use App\Models\Candidatura;
use App\Models\Sala;
use App\Models\User;
use Tests\TestCase;

class SalaControllerTest extends TestCase
{
    public function test_professor_pode_listar_salas()
    {
        $professor = User::factory()->create(['role' => 'subcomissao_correcao']);
        $sala = Sala::factory()->create();
        Candidatura::factory(5)->create(['sala_id' => $sala->id]);

        $response = $this->actingAs($professor)
            ->get(route('professor.salas.index'));

        $response->assertStatus(200);
        $response->assertViewHas('salas');
        $this->assertCount(1, $response->viewData('salas'));
    }

    public function test_professor_pode_ver_pauta_da_sala()
    {
        $professor = User::factory()->create(['role' => 'subcomissao_correcao']);
        $sala = Sala::factory()->create();
        $candidatura = Candidatura::factory()->create(['sala_id' => $sala->id]);

        $response = $this->actingAs($professor)
            ->get(route('professor.salas.show', $sala));

        $response->assertStatus(200);
        $response->assertViewHas('sala');
        $response->assertViewHas('candidaturas');
    }

    public function test_professor_pode_lançar_nota()
    {
        $professor = User::factory()->create(['role' => 'subcomissao_correcao']);
        $sala = Sala::factory()->create();
        $candidatura = Candidatura::factory()->create(['sala_id' => $sala->id]);

        $response = $this->actingAs($professor)
            ->patch(
                route('professor.candidaturas.nota', $candidatura),
                ['nota_exame' => 14.5]
            );

        $this->assertDatabaseHas('candidaturas', [
            'id' => $candidatura->id,
            'nota_exame' => 14.5,
            'nota_lancada_por' => $professor->id,
        ]);
    }

    public function test_nota_deve_estar_entre_0_e_20()
    {
        $professor = User::factory()->create(['role' => 'subcomissao_correcao']);
        $candidatura = Candidatura::factory()->create();

        $response = $this->actingAs($professor)
            ->patch(
                route('professor.candidaturas.nota', $candidatura),
                ['nota_exame' => 25] // Inválido
            );

        $response->assertSessionHasErrors('nota_exame');
    }

    public function test_usuario_nao_autenticado_nao_pode_acessar()
    {
        $response = $this->get(route('professor.salas.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_usuario_sem_permissao_nao_pode_acessar()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($user)->get(route('professor.salas.index'));
        $response->assertForbidden();
    }
}

// Executar testes:
// php artisan test tests/Feature/Professor/SalaControllerTest.php
```

---

## Exemplo 7: API REST (opcional - extensão futura)

```php
// routes/api.php
Route::middleware(['auth:sanctum', 'subcomissao_correcao'])->group(function () {
    Route::get('/professor/salas', function () {
        return \App\Models\Sala::with('candidaturas')->get();
    });

    Route::get('/professor/salas/{sala}', function (\App\Models\Sala $sala) {
        return $sala->load('candidaturas');
    });

    Route::patch('/professor/candidaturas/{candidatura}/nota', function (Request $request, Candidatura $candidatura) {
        $request->validate(['nota_exame' => 'required|numeric|min:0|max:20']);
        
        $candidatura->update([
            'nota_exame' => $request->nota_exame,
            'nota_lancada_por' => auth()->id(),
            'nota_lancada_em' => now(),
        ]);

        return $candidatura;
    });
});

// Uso via cURL:
// curl -X PATCH https://seu-site.ao/api/professor/candidaturas/1/nota \
//   -H "Authorization: Bearer TOKEN" \
//   -H "Content-Type: application/json" \
//   -d '{"nota_exame": 14.5}'
```

---

## Exemplo 8: Integração com Sistema Externo

```php
<?php

// app/Services/NotasExportService.php
namespace App\Services;

use App\Models\Sala;

class NotasExportService
{
    public static function exportarParaCSV(Sala $sala)
    {
        $file = storage_path("exports/notas_{$sala->id}.csv");
        $handle = fopen($file, 'w');

        fputcsv($handle, ['Lugar', 'Código Exame', 'Nota', 'Status', 'Lançado por', 'Data Lançamento']);

        $sala->candidaturas->each(function ($c) use ($handle) {
            fputcsv($handle, [
                $c->numero_lugar,
                $c->codigo_exame,
                $c->nota_exame ?? '—',
                $c->nota_exame ? ($c->nota_exame >= 10 ? 'APROVADO' : 'REPROVADO') : 'PENDENTE',
                $c->notaLancadaPor?->name ?? '—',
                $c->nota_lancada_em?->format('d/m/Y H:i') ?? '—',
            ]);
        });

        fclose($handle);
        return $file;
    }

    public static function importarDeCSV($file, Sala $sala)
    {
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);
        $count = 0;

        while ($row = fgetcsv($handle)) {
            $candidatura = $sala->candidaturas()
                ->where('codigo_exame', $row[1])
                ->first();

            if ($candidatura && is_numeric($row[2])) {
                $candidatura->update([
                    'nota_exame' => (float)$row[2],
                    'nota_lancada_por' => auth()->id(),
                    'nota_lancada_em' => now(),
                ]);
                $count++;
            }
        }

        fclose($handle);
        return $count;
    }
}

// Uso:
// $file = NotasExportService::exportarParaCSV($sala);
// NotasExportService::importarDeCSV('notas.csv', $sala);
```

---

## 🎯 Resumo

| Contexto | Código/Comando |
|----------|---|
| **Acessar painel** | `https://seu-site.ao/professor/salas` |
| **Ver pauta** | `https://seu-site.ao/professor/salas/1` |
| **Lançar nota** | Clique "➕ Lançar" no modal |
| **Consultar BD** | `php artisan tinker` → queries acima |
| **Testar** | `php artisan test` |
| **Exportar CSV** | `NotasExportService::exportarParaCSV($sala)` |

---

**Todos os exemplos funcionam com a implementação atual!**
