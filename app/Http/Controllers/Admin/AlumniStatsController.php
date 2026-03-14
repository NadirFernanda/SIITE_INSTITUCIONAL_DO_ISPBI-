<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AlumniStat;

class AlumniStatsController extends Controller
{
    public function edit()
    {
        $stats = AlumniStat::first();
        if (! $stats) {
            $stats = AlumniStat::create([]);
        }
        return view('admin.alumni-stats', compact('stats'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'alumni_count' => 'required|integer|min:0',
            'employability_percentage' => 'required|integer|min:0|max:100',
            'countries_count' => 'required|integer|min:0',
            'companies_founded' => 'required|integer|min:0',
        ]);

        AlumniStat::updateOrCreate([], $data);

        return redirect()->route('admin.alumni.stats')->with('success', 'Indicadores atualizados.');
    }
}
