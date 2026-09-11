<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlumniExport implements FromCollection, WithHeadings
{
    public function __construct(private readonly Collection $alumni)
    {
    }

    public function collection(): Collection
    {
        return $this->alumni->map(fn ($alumnus) => [
            'ID' => $alumnus->id,
            'Nome' => $alumnus->nome,
            'Email' => $alumnus->user?->email ?? '',
            'Curso' => $alumnus->curso,
            'Ano de conclusão' => $alumnus->ano,
            'Situação profissional' => $alumnus->trabalha ? 'Trabalha' : 'Não trabalha',
            'Empresa' => $alumnus->empresa ?? '',
            'Cargo' => $alumnus->cargo ?? '',
            'País' => $alumnus->pais ?? '',
            'Contacto' => $alumnus->contacto ?? '',
            'Publicado' => $alumnus->publicado ? 'Sim' : 'Não',
            'Testemunho' => $alumnus->testemunho ? 'Sim' : 'Não',
            'Portal aprovado' => $alumnus->user?->aprovado ? 'Sim' : 'Não',
            'Data de registo' => optional($alumnus->created_at)->format('Y-m-d H:i'),
        ]);
    }

    public function headings(): array
    {
        return [
            'ID', 'Nome', 'Email', 'Curso', 'Ano de conclusão',
            'Situação profissional', 'Empresa', 'Cargo', 'País', 'Contacto',
            'Publicado', 'Testemunho', 'Portal aprovado', 'Data de registo',
        ];
    }
}
