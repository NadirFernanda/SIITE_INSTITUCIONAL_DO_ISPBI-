<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::orderByDesc('created_at');

        if ($request->filled('accao')) {
            $query->where('accao', $request->input('accao'));
        }
        if ($request->filled('user')) {
            $query->where('user_nome', 'like', '%' . $request->input('user') . '%');
        }
        if ($request->filled('modelo_id')) {
            $query->where('modelo_id', (int) $request->input('modelo_id'));
        }

        $logs   = $query->paginate(50)->withQueryString();
        $accoes = AuditLog::distinct()->orderBy('accao')->pluck('accao');

        return view('admin.auditoria.index', compact('logs', 'accoes'));
    }
}
