<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;

class InstitucionalController extends Controller
{
    public function index()
    {
                return view('pages.institucional');
    }
}
