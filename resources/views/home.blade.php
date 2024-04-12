<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="ap-site">
    <main class="ap-container">
        <div class="nav">
            <a class="nav-front">AProject</a>
            <div class="nav-back">
                <a class="nav-entry" id="nav-active" href="/">Home</a>
                @if(session('id') == null)
                    <a class="nav-entry" href="/projects">Projects</a>
                    <a class="nav-entry" href="/login">Login</a>
                    <a class="nav-entry" href="/register">Register</a>
                @else
                    <a class="nav-entry" href="/dashboard">Dashboard</a>
                    <a class="nav-entry" href="/projects">Projects</a>
                    <a class="nav-entry" href="/logout">Logout</a>
                @endif
            </div>
        </div>

        <header class="hero">
            <div class="stretchable">
                <h1>AProject</h1>
                <h2>Aston Computer Science Project Management</h2>
            </div>
        </header>

        <div class="stretchable">
            <h1>Welcome</h1>
            <p>
                Welcome to AProject, an easy-to-use project management system. To get started, please register for an account. If you have already done this, click login.
            </p>
            <h1>Active projects?</h1>
            <p>
                To view all active projects, please select projects above.
            </p>
        </div>
    </main>
    @include("footer")
</body>
</html>
