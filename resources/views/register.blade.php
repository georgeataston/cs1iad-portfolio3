<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="ap-site">
    <main class="ap-container">
        <div class="nav">
            <a class="nav-front">AProject</a>
            <div class="nav-back">
                <a class="nav-entry" href="/">Home</a>
                <a class="nav-entry" href="/projects">Projects</a>
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

        <div class="stretchable">
            @if (session('success') == "false")
                <div class="form-error">
                    <h1 id="form-white">Error</h1>
                    <h2 id="form-white">{{ session('message') }}</h2>
                </div>
            @endif
            <h1>Want to start managing your projects better?</h1>
            <h2>Please fill out the form below.</h2>
            <br>
            <form class="form" id="register-form" action="/register" method="post">
                @csrf
                <label class="form-label" for="username">Username</label><br>
                <input class="form-regular form-noselect" type="text" id="username" name="username" value="{{old('username')}} "/>
                @error('username')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="email">E-mail</label><br>
                <input class="form-regular form-noselect" type="text" id="email" name="email" value="{{old('email')}}" />
                @error('email')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="password">Password</label><br>
                <input class="form-regular form-noselect" type="password" id="password" name="password" value="{{old('password')}}" />
                @error('password')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <label class="form-label" for="confirm_password">Confirm Password</label><br>
                <input class="form-regular form-noselect" type="password" id="confirm_password" name="confirm_password" value="{{old('confirm_password')}}" />
                @error('confirm_password')<br><span class="form-inline-error">{{ $message }}</span><br>@enderror

                <br><br>
                <button class="form-submit">Submit</button>
                <br><br>
            </form>
        </div>
    </main>
    @include("footer")
</body>
</html>
