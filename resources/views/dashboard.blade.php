<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="ap-site">
    <main class="ap-container">
        <div class="nav">
            <a class="nav-front">AProject</a>
            <div class="nav-back">
                <a class="nav-entry" href="/">Home</a>
                <a class="nav-entry" id="nav-active" href="/dashboard">Dashboard</a>
                <a class="nav-entry" href="/logout">Logout</a>
            </div>
        </div>

        <header class="hero">
            <div class="stretchable">
                <h1>Dashboard</h1>
                <h2>Please select a project, or create a new one</h2>
            </div>
        </header>

        <div class="stretchable">
            @if (session('delete'))
                <div class="form-success">
                    <h1 id="form-white">Deletion Successful</h1>
                    <h2 id="form-white">{{session('delete')}} has been deleted.</h2>
                </div>
            @endif
            @if($projects->isEmpty())
                <p>You don't have any projects.</p>
                <br>
                <a href="/project/create" class="form-submit-multi">Create Project</a>
                <a href="/project/search" class="form-submit-multi">Project Search</a>
            @else
                <br><br>
                <a href="/project/create" class="form-submit-multi">Create Project</a>
                <a href="/project/search" class="form-submit-multi">Project Search</a>
                <br><br>
                <p>Select the title of the project below to view its details and manage its status.</p>
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
