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
            <h1>{{ $project->title }}</h1>
            <h2>Due on: {{ $project->end_date }}</h2>
        </div>
    </header>

    <div class="stretchable">
        <p class="breadcrum-back"><a href="/dashboard" class="link-grey">&lt back</a></p>
        @if (session('success') == "true")
            <div class="form-success">
                <h1 id="form-white">Edit Successful</h1>
                <h2 id="form-white">Your project has been updated.</h2>
            </div>
        @endif
        <br>
        <form class="form" id="edit-form" method="get" action="/project/{{$project->pid}}/edit">
            <label class="form-label" for="title">Title</label><br>
            <input class="form-regular form-noselect" type="text" id="title" name="title" value="{{$project->title}}" disabled/>
            @error('title')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="start_date">Start Date</label><br>
            <input class="form-regular form-noselect" type="date" id="start_date" name="start_date" value="{{$project->start_date}}" disabled />
            @error('start_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="end_date">End Date</label><br>
            <input class="form-regular form-noselect" type="date" id="end_date" name="end_date" value="{{$project->end_date}}" disabled/>
            @error('end_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="description">Description</label><br>
            <textarea class="form-regular form-noselect" type="text" id="description" name="description" disabled>{{$project->description}}</textarea>
            @error('description')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label">The current status of your project is {{$project->phase}}.</label>
            <br><br>
            @error('login')<span class="form-inline-error-button">{{ $message }}</span><br>@enderror
            <button class="form-submit-multi" >Edit</button>
            <button class="form-submit-multi" formaction="/project/{{$project->pid}}/delete" formmethod="get">Delete</button>
            <br><br>
        </form>
    </div>
</main>
@include("footer")
</body>
</html>
