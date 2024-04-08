<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$project->title}} | AProject</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="ap-site">
<main class="ap-container">
    <div class="nav">
        <a class="nav-front">AProject</a>
        <div class="nav-back">
            <a class="nav-entry" href="/">Home</a>
            <a class="nav-entry" href="/dashboard">Dashboard</a>
            <a class="nav-entry" href="/logout">Logout</a>
        </div>
    </div>

    <header class="hero">
        <div class="stretchable">
            <h1>Deleting {{ $project->title }}</h1>
            <h2>Due on: {{ $project->end_date }}</h2>
        </div>
    </header>

    <div class="stretchable">
        <div class="form-error">
            <h1 id="form-white">ARE YOU SURE?</h1>
            <h2 id="form-white">You are about to delete project {{$project->title}}. This action cannot be undone.</h2>
        </div>
        <br>
        <form class="form" id="delete-form" method="post" action="/project/{{$project->pid}}/delete">
            @csrf
            <button class="form-submit-multi">Delete</button>
            <button class="form-submit-multi" formaction="/project/{{$project->pid}}" formmethod="get">Cancel</button>
            <br><br>
        </form>
    </div>
</main>
@include("footer")
</body>
</html>
