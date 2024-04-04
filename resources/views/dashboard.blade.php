<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dashboard | AProject</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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

<main class="stretchable">

</main>
</body>

@include("footer");
</html>
