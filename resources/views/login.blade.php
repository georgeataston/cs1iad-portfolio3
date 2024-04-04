<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="ap-site">
    <main class="ap-container">
        <div class="nav">
            <a class="nav-front">AProject</a>
            <div class="nav-back">
                <a class="nav-entry" href="/">Home</a>
                <a class="nav-entry" id="nav-active" href="/login">Login</a>
                <a class="nav-entry" href="/register">Register</a>
            </div>
        </div>

        <header class="hero">
            <div class="stretchable">
                <h1>Login</h1>
                <h2>Login to your AProject account</h2>
            </div>
        </header>

        <div class="stretchable">
            @if (session('success') == "true")
                <div class="form-success">
                    <h1 id="form-white">Registration Successful</h1>
                    <h2 id="form-white">You are now able to log in.</h2>
                </div>
            @endif
            <h1>Please log in with the form below</h1>
            <br>
            <form class="form" id="login-form" action="/login" method="post">
                @csrf
                <label class="form-label" for="username">Username</label><br>
                <input class="form-regular" type="text" id="username" name="username" value="{{old('username')}}" />
                @error('username')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="password">Password</label><br>
                <input class="form-regular" type="password" id="password" name="password" value="{{old('password')}}" />
                @error('password')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                @error('login')<span class="form-inline-error-button">{{ $message }}</span><br>@enderror
                <button class="form-submit">Login</button>
                <br><br>
            </form>
        </div>
    </main>
    @include("footer")
</body>
</html>
