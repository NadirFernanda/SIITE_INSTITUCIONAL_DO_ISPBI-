<?php

namespace App\Http\Controllers\Daac;

use App\Http\Controllers\Controller;
use App\Models\Sala;

class SalaController extends Controller
{
    public function index()
    {
        $salas = Sala::withCount('candidaturas')->orderBy('nome')->get();
        return view('daac.salas.index', compact('salas'));
    }

    public function show(Sala $sala)
    {
        $candidaturas = $sala->candidaturas()->orderBy('numero_lugar')->get();
        return view('daac.salas.show', compact('sala', 'candidaturas'));
    }

}
