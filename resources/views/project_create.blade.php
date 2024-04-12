<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project Creation | AProject</title>
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
                <h1>Project Creation</h1>
                <h2>Create a new project</h2>
            </div>
        </header>

        <div class="stretchable">
            <p class="breadcrum-back"><a href="{{back()->getTargetUrl()}}" class="link-grey">&lt back</a></p>
            @if (session('success') == "false")
                <div class="form-error">
                    <h1 id="form-white">Error</h1>
                    <h2 id="form-white">{{ session('message') }}</h2>
                </div>
            @endif
            <h1>Create a new project by filling out the below form.</h1>
            <br>
            <form class="form" id="create-form" action="/project/create" method="post">
                @csrf
                <label class="form-label" for="title">Title</label><br>
                <input class="form-regular form-noselect" type="text" id="title" name="title" value="{{old('title')}}" />
                @error('title')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="start_date">Start Date</label><br>
                <input class="form-regular form-noselect" type="date" id="start_date" name="start_date" value="{{old('start_date')}}" />
                @error('start_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="end_date">End Date</label><br>
                <input class="form-regular form-noselect" type="date" id="end_date" name="end_date" value="{{old('end_date')}}" />
                @error('end_date')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="description">Description</label><br>
                <textarea class="form-regular form-noselect" type="text" id="description" name="description">{{old('description')}}</textarea>
                @error('description')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                @error('login')<span class="form-inline-error-button">{{ $message }}</span><br>@enderror
                <button class="form-submit">Create</button>
                <br><br>
            </form>
        </div>
    </main>
    @include("footer")
</body>
</html>
