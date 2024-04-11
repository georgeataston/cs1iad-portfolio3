<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search | AProject</title>
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
                <h1>Search</h1>
                <h2>Search for a project</h2>
            </div>
        </header>

        <div class="stretchable">
            @if (session('success') == "false")
                <div class="form-error">
                    <h1 id="form-white">Error</h1>
                    <h2 id="form-white">{{ session('message') }}</h2>
                </div>
            @endif
            <h1>Please choose to search either via project title or start date.</h1>
            <br>
            <form class="form" id="search-form" action="/project/search" method="post">
                @csrf
                <label class="form-label" for="title">Title</label><br>
                <input class="form-regular form-noselect" type="text" id="title" name="title" value="{{old('title')}}" />
                @error('title')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="start_date">Start Date</label><br>
                <input class="form-regular form-noselect" type="date" id="start_date" name="start_date" value="{{old('start_date')}}" />
                @error('start_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                @error('submit')<span class="form-inline-error-button">{{ $message }}</span><br>@enderror
                <button class="form-submit">Search</button>
                <br><br>
            </form>

            @if(session('projects'))
                @php
                    $projects = session('projects');
                @endphp
                @if($projects->isEmpty())
                    <p>No projects matched your search query.</p>
                @else
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
                @endif
            @endif
        </div>
    </main>
    @include("footer")
</body>
</html>
