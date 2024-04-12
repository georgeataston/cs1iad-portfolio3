<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Projects | AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="ap-site">
<main class="ap-container">
    <div class="nav">
        <a class="nav-front">AProject</a>
        <div class="nav-back">
            <a class="nav-entry" href="/">Home</a>
            @if(session('id') == null)
                <a class="nav-entry" id="nav-active" href="/projects">Projects</a>
                <a class="nav-entry" href="/login">Login</a>
                <a class="nav-entry" href="/register">Register</a>
            @else
                <a class="nav-entry" href="/dashboard">Dashboard</a>
                <a class="nav-entry" id="nav-active" href="/projects">Projects</a>
                <a class="nav-entry" href="/logout">Logout</a>
            @endif
        </div>
    </div>

    <header class="hero">
        <div class="stretchable">
            <h1>Projects</h1>
            <h2>List of all active projects.</h2>
        </div>
    </header>

    <div class="stretchable">
        <br><br>
        <a href="/project/search" class="form-submit-multi">Project Search</a>
        <br><br>
        @if($projects->isEmpty())
            <p>There aren't any active projects.</p>
        @else
            <p>Select the title of the project below to view its details.</p>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Phase</th>
                </tr>
                @foreach ($projects as $project)
                    <tr>
                        <td><a href="/project/{{$project->pid}}" class="link">{{$project->title}}</a></td>
                        <td>{{$project->start_date}}</td>
                        <td>{{$project->end_date}}</td>
                        <td>{{$project->phase}}</td>
                    </tr>
                @endforeach
            </table>
            <br>
        @endif
        <br><br><br>
    </div>
</main>
@include("footer")
</body>
</html>
