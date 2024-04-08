<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

        return redirect('/project/' . $project->pid);
    }

    public function update(Request $request, int $id): RedirectResponse {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'description' => 'required|max:255',
            'phase' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->with('old', 'true')->withInput();
        }

        if (!($request->phase == "Not Started" || $request->phase == "In Progress" || $request->phase == "Complete")) {
            return back()->withErrors(['phase' => 'Please select a valid phase'])->withInput();
        }

        $project = Project::where('pid', '=', $id)->first();
        if ($project == null) {
            abort(404);
        }

        $user = User::where('uid', '=', session('id'))->first();

        if ($project->user_uid != $user->uid) {
            abort(403);
        }

        $project->title = $request->title;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->description = $request->description;
        $project->phase = $request->phase;
        $project->update();

        return redirect('/project/' . $project->pid)->with('success', 'true');
    }

    public function delete(Request $request, int $id): RedirectResponse {
        $project = Project::where('pid', '=', $id)->first();
        if ($project == null) {
            abort(404);
        }

        $user = User::where('uid', '=', session('id'))->first();

        if ($project->user_uid != $user->uid) {
            abort(403);
        }

        $title = $project->title;
        $project->delete();

        return redirect('/dashboard')->with('delete', $title);
    }

    public function search(Request $request): RedirectResponse {
        if ($request->title == null && $request->start_date == null) {
            return back()->withErrors(['submit' => 'Please use one of the above fields.'])->withInput();
        }

        if ($request->title != null && $request->start_date != null) {
            return back()->withErrors(['submit' => 'Please only use one of the above fields.'])->withInput();
        }

        if ($request->title != null) {
            $input = $request->validate([
                'title' => 'string|max:100'
            ]);

            $projects = Project::where('title', 'LIKE', '%' . $input['title'] . '%')->where('user_uid', '=', session('id'))->get();
            return back()->withInput()->with('projects', $projects);
        } else {
            $input = $request->validate([
                'start_date' => 'date'
            ]);

            $projects = Project::where('start_date', '=', $input['start_date'])->where('user_uid', '=', session('id'))->get();
            return back()->withInput()->with('projects', $projects);
        }
    }
}
