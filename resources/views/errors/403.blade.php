<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>403 | AProject</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="ap-site">
<main class="ap-container">
    <div class="nav">
        <a class="nav-front">AProject</a>
        <div class="nav-back">
            <a class="nav-entry" href="/">Home</a>
            @if(session('id') == null)
                <a class="nav-entry" href="/login">Login</a>
                <a class="nav-entry" href="/register">Register</a>
            @else
                <a class="nav-entry" href="/dashboard">Dashboard</a>
                <a class="nav-entry" href="/logout">Logout</a>
            @endif
        </div>
    </div>

    <header class="hero">
        <div class="stretchable">
            <h1>Error 403</h1>
            <h2>Forbidden</h2>
        </div>
    </header>

    <div class="stretchable">
        <p class="breadcrum-back"><a href="{{back()->getTargetUrl()}}" class="link-grey">&lt back</a></p>
        <h1>What went wrong?</h1>
        <p>
            You don't have permission to access the requested resource. Please log in with a user account that has permission to continue.
        </p>
    </div>
</main>
@include("footer")
</body>
</html>
