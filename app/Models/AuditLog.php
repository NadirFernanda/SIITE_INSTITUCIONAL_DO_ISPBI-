<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    public const UPDATED_AT = null;

    protected $guarded = [];

    protected $casts = ['created_at' => 'datetime'];

    public static function registar(
        string  $accao,
        ?string $modelo    = null,
        ?int    $modeloId  = null,
        ?string $descricao = null
    ): void {
        $user = Auth::user();
        try {
            static::create([
                'user_id'   => $user?->id,
                'user_nome' => $user?->name ?? 'Sistema',
                'user_role' => $user?->role ?? '—',
                'accao'     => $accao,
                'modelo'    => $modelo,
                'modelo_id' => $modeloId,
                'descricao' => $descricao,
                'ip'        => request()->ip(),
            ]);
        } catch (\Throwable) {
            // Auditoria nunca deve interromper o fluxo principal
        }
    }

    public static $accaoLabels = [
        'criou_candidatura'     => 'Criou candidatura',
        'editou_candidatura'    => 'Editou candidatura',
        'alterou_status'        => 'Alterou estado',
        'eliminou_candidatura'  => 'Eliminou candidatura',
        'assinou_candidatura'   => 'Assinou candidatura',
        'rejeitou_candidatura'  => 'Rejeitou candidatura',
        'imprimiu_comprovativo' => 'Imprimiu comprovativo',
        'distribuiu_salas'      => 'Distribuiu salas',
        'limpou_salas'          => 'Limpou distribuição',
        'criou_usuario'         => 'Criou utilizador',
        'eliminou_usuario'      => 'Eliminou utilizador',
        'resetou_password'      => 'Resetou password',
    ];
}
