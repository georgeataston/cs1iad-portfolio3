<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function create(Request $request): RedirectResponse {
        $input = $request->validate([
            'title' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|max:255'
        ]);

        $project = new Project;
        $project->title = $input['title'];
        $project->start_date = $input['start_date'];
        $project->end_date = $input['end_date'];
        $project->description = $input['description'];
        $project->phase = "Not Started";
        $project->user_uid = $request->session()->get('id');
        $project->save();

        return redirect('/projects/' . $project->pid);
    }
}
