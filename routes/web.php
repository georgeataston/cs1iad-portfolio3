<?php

use App\Http\Controllers\ProjectController;
use App\Http\Middleware\ReverseUserAuthCheck;
use App\Http\Middleware\UserAuthCheck;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('home');
});

// Registering / Logging in

Route::get('/register', function () {
    return view('register');
})->middleware(ReverseUserAuthCheck::class);

Route::post('/register', [UserController::class, 'create'])->middleware(ReverseUserAuthCheck::class);

Route::get('/login', function () {
    return view('login');
})->middleware(ReverseUserAuthCheck::class);

Route::post('/login', [UserController::class, 'authenticate'])->middleware(ReverseUserAuthCheck::class);

Route::get('/logout', [UserController::class, 'logout']);

// Dashboard

Route::get('/dashboard', function() {
    $user = User::where('uid', '=', session('id'))->first();
    $projects = $user->projects;
    return view('dashboard')->with('projects', $projects);
})->middleware(UserAuthCheck::class);

// Public Projects view
Route::get('/projects', function() {
    $projects = Project::where('phase', '!=', 'Complete')->get();
    return view('projects')->with('projects', $projects);
});

// Project Creation

Route::get('/project/create', function() {
    return view('project_create');
})->middleware(UserAuthCheck::class);

Route::post('/project/create', [ProjectController::class, 'create'])->middleware(UserAuthCheck::class);

// Project Search

Route::get('/project/search', function() {
    return view('project_search');
});

Route::post('/project/search', [ProjectController::class, 'search']);

// View / Edit / Delete a project

Route::get('/project/{id}', function (string $id) {
    if (!is_numeric($id))
        abort('418');

    $project = Project::where('pid', '=', $id)->first();
    if ($project == null)
        abort('404');

    $enableControls = $project->user_uid == session('id');
    $projOwner = User::where('uid', '=', $project->user_uid)->first();
    $projUser = $projOwner->username;
    $projEmail = "please login to view e-mail";
    if (session('id'))
        $projEmail = $projOwner->email;

    return view('project_view')->with('project', $project)->with('enableControls', $enableControls)->with('projUser', $projUser)->with('projEmail', $projEmail);
});

Route::get('/project/{id}/edit', function (string $id) {
    if (!is_numeric($id))
        abort('418');

    $project = Project::where('pid', '=', $id)->first();
    if ($project == null) {
        abort(404);
    }

    if ($project->user_uid != session('id')) {
        abort(403);
    }

    return view('project_edit')->with('project', $project);
})->middleware(UserAuthCheck::class);

Route::post('/project/{id}/edit', [ProjectController::class, 'update'])->middleware(UserAuthCheck::class);

Route::get('/project/{id}/delete', function (string $id) {
    if (!is_numeric($id))
        abort('418');

    $project = Project::where('pid', '=', $id)->first();
    if ($project == null) {
        abort(404);
    }

    if ($project->user_uid != session('id')) {
        abort(403);
    }

    return view('project_delete')->with('project', $project);
})->middleware(UserAuthCheck::class);

Route::post('/project/{id}/delete', [ProjectController::class, 'delete'])->middleware(UserAuthCheck::class);

