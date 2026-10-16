<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        $formularioAtivo = SiteSetting::candidaturasAtivas();

        return view('admin.configuracoes', compact('formularioAtivo'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'candidaturas_ativas' => ['required', 'boolean'],
        ]);

        SiteSetting::query()->updateOrCreate(
            ['key' => SiteSetting::CANDIDATURAS_ATIVAS],
            ['value' => (bool) $validated['candidaturas_ativas']]
        );

        return redirect()->route('admin.configuracoes')
            ->with('success', $validated['candidaturas_ativas']
                ? 'Formulário de candidaturas activado.'
                : 'Formulário de candidaturas desactivado.');
    }
}
