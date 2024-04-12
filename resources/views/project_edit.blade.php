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
            <a class="nav-entry" id="nav-active" href="/projects">Projects</a>
            <a class="nav-entry" href="/logout">Logout</a>
        </div>
    </div>

    <header class="hero">
        <div class="stretchable">
            <h1>Editing {{ $project->title }}</h1>
            <h2>Due on: {{ $project->end_date }}</h2>
        </div>
    </header>

    <div class="stretchable">
        <p class="breadcrum-back"><a href="/project/{{$project->pid}}" class="link-grey">&lt back</a></p>
        <h1>Please make your changes below then press submit.</h1>
        <br>
        <form class="form" id="edit-form" method="post" action="/project/{{$project->pid}}/edit">
            @csrf
            <label class="form-label" for="title">Title</label><br>
            <input class="form-regular form-noselect" type="text" id="title" name="title" value="{{session('old') ? old('title') : $project->title}}"/>
            @error('title')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="start_date">Start Date</label><br>
            <input class="form-regular form-noselect" type="date" id="start_date" name="start_date" value="{{session('old') ? old('start_date') : $project->start_date}}" />
            @error('start_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="end_date">End Date</label><br>
            <input class="form-regular form-noselect" type="date" id="end_date" name="end_date" value="{{session('old') ? old('end_date') : $project->end_date}}"/>
            @error('end_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="description">Description</label><br>
            <textarea class="form-regular form-noselect" type="text" id="description" name="description" >{{session('old') ? old('description') : $project->description}}</textarea>
            @error('description')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            <label class="form-label" for="phase">Phase</label><br>
            <select class="form-select form-noselect" name="phase" id="phase">
                <option value="Not Started" {{$project->phase == 'Not Started' ? 'selected' : ''}}>Not Started</option>
                <option value="In Progress" {{$project->phase == 'In Progress' ? 'selected' : ''}}>In Progress</option>
                <option value="Complete" {{$project->phase == 'Complete' ? 'selected' : ''}}>Complete</option>
            </select>
            @error('phase')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

            <br><br>
            @error('submit')<span class="form-inline-error-button">{{ $message }}</span><br>@enderror
            <button class="form-submit">Submit</button>
            <br><br>
        </form>
    </div>
</main>
@include("footer")
</body>
</html>
