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

// Project Creation

Route::get('/project/create', function() {
    return view('project_create');
})->middleware(UserAuthCheck::class);

Route::post('/project/create', [ProjectController::class, 'create'])->middleware(UserAuthCheck::class);

// View / Edit / Delete a project

Route::get('/project/{id}', function (string $id) {
    $project = Project::where('pid', '=', $id)->first();
    if ($project == null) {
        abort(404);
    }

    $user = User::where('uid', '=', session('id'))->first();

    if ($project->user_uid != $user->uid) {
        abort(403);
    }

    return view('project_view')->with('project', $project);
})->middleware(UserAuthCheck::class);

Route::get('/project/{id}/edit', function (string $id) {
    $project = Project::where('pid', '=', $id)->first();
    if ($project == null) {
        abort(404);
    }

    $user = User::where('uid', '=', session('id'))->first();

    if ($project->user_uid != $user->uid) {
        abort(403);
    }

    return view('project_edit')->with('project', $project);
})->middleware(UserAuthCheck::class);

Route::post('/project/{id}/edit', [ProjectController::class, 'update'])->middleware(UserAuthCheck::class);

Route::get('/project/{id}/delete', function (string $id) {
    $project = Project::where('pid', '=', $id)->first();
    if ($project == null) {
        abort(404);
    }

    $user = User::where('uid', '=', session('id'))->first();

    if ($project->user_uid != $user->uid) {
        abort(403);
    }

    return view('project_delete')->with('project', $project);
})->middleware(UserAuthCheck::class);

Route::post('/project/{id}/delete', [ProjectController::class, 'delete'])->middleware(UserAuthCheck::class);
