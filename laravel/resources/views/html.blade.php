<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('meta-title', 'Demo Laravel & Vue')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h3 class="mb-5">Demo Laravel & Vue</h3>
    <div class="row">
        <div class="col-md-3">
            <h4 class="mb-3">Web</h4>
            <hr>
            <ul>
                <li>
                    <a href="{{route('news.list')}}">News</a>
                </li>
                <li>
                    <a href="{{route('tags.list')}}">Tags</a>
                </li>
            </ul>
            <h4 class="mb-3">SPA</h4>
            <hr>
            <ul>
                <li>
                    <a href="/spa/news/list">News</a>
                </li>
                <li>
                    <a href="/spa/tags/list">Tags</a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <h4 class="mb-3">@yield('title')</h4>
            <hr>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
