<?php

namespace App\Http\Controllers\Daac;

use App\Http\Controllers\Controller;
use App\Models\Sala;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::query()
            ->withCount(['candidaturas' => function ($query) {
                $query->where('pagamento_confirmado', true);
            }])
            ->orderBy('nome')
            ->get()
            ->filter(fn($sala) => $sala->candidaturas_count > 0);
        
        return view('daac.salas.index', compact('salas'));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()
            ->where('pagamento_confirmado', true)
            ->orderBy('numero_lugar')
            ->get();
        return view('daac.salas.show', compact('sala', 'candidaturas'));
    }

}
