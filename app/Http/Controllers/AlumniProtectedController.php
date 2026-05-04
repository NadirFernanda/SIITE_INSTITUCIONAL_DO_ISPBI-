<?php

namespace App\Http\Controllers;

use App\Models\Alumnus;
use Illuminate\Http\Request;

/**
 * AlumniProtectedController - Dados sensíveis de alumni
 * SEGURANÇA: Apenas acessível para utilizadores autenticados
 * Previne exposição de dados pessoais (nomes, cargos, empresas, contactos)
 */
class AlumniProtectedController extends Controller
{
    public function __construct()
    {
        // Requer autenticação para todos os métodos
        $this->middleware('auth');
    }

    /**
     * Mostra dados completos do alumnus apenas para utilizadores autenticados
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $alumnus = Alumnus::where('id', $id)
            ->where('publicado', true)
            ->firstOrFail();

        return view('pages.alumni-protected-show', compact('alumnus'));
    }
}

