<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfiguracaoController extends Controller
{
    public function index()
    {
        // Exemplo: configurações estáticas
        $configuracoes = [
            ['chave' => 'site_name', 'valor' => 'Meu Site'],
            ['chave' => 'email', 'valor' => 'contato@meusite.com'],
        ];
        return view('admin.configuracoes', compact('configuracoes'));
    }
}
