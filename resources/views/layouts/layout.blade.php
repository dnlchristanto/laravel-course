<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
</head>
<body>
    <header>
        @include('layouts.header')
    </header>
    <ul>
        @section('sidebar')
        <li>HTML</li>
        <li>CSS</li>
        <li>JScript</li>
        @show
    </ul>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
