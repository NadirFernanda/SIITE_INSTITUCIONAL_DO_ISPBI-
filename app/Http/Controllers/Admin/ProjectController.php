<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        // Defence-in-depth: enforce both auth AND admin at controller level
        // in addition to the route-group middleware.
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'status' => 'required|in:em_curso,em_avaliacao,concluido',
            'lead' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'link' => 'nullable|url',
        ]);

        Project::create($data);
        return redirect()->route('admin.projects.index')->with('success', 'Projecto criado.');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'status' => 'required|in:em_curso,em_avaliacao,concluido',
            'lead' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'link' => 'nullable|url',
        ]);

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Projecto actualizado.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Projecto eliminado.');
    }
}
