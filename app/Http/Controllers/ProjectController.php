<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Public listing grouped by status
    public function index()
    {
        $projects = Project::orderBy('start_date', 'desc')->get()->groupBy('status');
        return view('pages.investigacao', ['projects' => $projects]);
    }
}
