<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>AProject</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="nav">
            <a class="nav-front">AProject</a>
            <div class="nav-back">
                <a class="nav-entry" id="nav-active" href="/">Home</a>
                <a class="nav-entry" href="/login">Login</a>
                <a class="nav-entry" href="/register">Register</a>
            </div>
        </div>
        <header class="hero">
            <div class="stretchable">
                <h1>AProject</h1>
                <h2>Aston Computer Scinece Project Management</h2>
            </div>
        </header>

        <main class="stretchable">
            <h1>Welcome</h1>
            <p>
                Welcome to AProject, an easy-to-use project management system. To get started, please register for an account. If you have already done this, click login.
            </p>
        </main>
    </body>

    @include("footer");
</html>
