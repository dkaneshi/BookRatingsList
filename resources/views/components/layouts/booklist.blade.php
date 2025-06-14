<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite('resources/css/app.css')
</head>
<body>
<nav>
    <div>
        <h1>My Book Reviews</h1>
        <a
            wire:navigate
            @class(['active' => request()->is('/')])
            href="/">
            Book List
        </a>
        <a
            wire:navigate
            @class(['active' => request()->is('create')])
            href="/create">
            Add a Book
        </a>
    </div>
</nav>
<main>
    {{ $slot }}
</main>
</body>
</html>
