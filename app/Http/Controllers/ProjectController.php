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
            'startdate' => 'required|date',
            'enddate' => 'required|date',
            'description' => 'required|max:255'
        ]);

        $project = new Project;
        $project->title = $input['title'];
        $project->start_date = $input['startdate'];
        $project->end_date = $input['enddate'];
        $project->description = $input['description'];
        $project->phase = "Not Started";
        $project->user_uid = $request->session()->get('id');
        $project->save();

        return redirect('/projects/' . $project->pid);
    }
}
