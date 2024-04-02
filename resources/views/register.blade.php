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
                <a class="nav-entry" href="/">Home</a>
                <a class="nav-entry" href="/login">Login</a>
                <a class="nav-entry" id="nav-active" href="/register">Register</a>
            </div>
        </div>
        <header class="hero">
            <div class="stretchable">
                <h1>Register</h1>
                <h2>Register for an AProject account</h2>
            </div>
        </header>

        <main class="stretchable">
            <h1>Want to start managing your projects better?</h1>
            <h2>Please fill out the form below</h2>
            <form class="form" id="register-form" action="/register" method="post">
                @csrf
                <label class="form-label" for="username">Username</label><br>
                <input class="form-regular" type="text" id="username" name="username" required/>

                <br><br>
                <label class="form-label" for="email">E-mail</label><br>
                <input class="form-regular" type="text" id="email" name="email" required/>

                <br><br>
                <label class="form-label" for="password">Password</label><br>
                <input class="form-regular" type="password" id="password" name="password" required/>

                <br><br>
                <button class="form-submit">Submit</button>
                <br><br>
            </form>
        </main>
    </body>

    @include("footer");
</html>
