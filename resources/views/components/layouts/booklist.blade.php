<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

    <flux:brand href="/" logo="{{ asset('logoipsum-357.png') }}" name="BookList"
                class="max-lg:hidden dark:hidden"/>
    <flux:brand href="/" logo="{{ asset('logoipsum-357.png') }}" name="BookList"
                class="max-lg:hidden! hidden dark:flex"/>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="/" current>Home</flux:navbar.item>
        <flux:navbar.item icon="inbox" href="/books/create">Add a Book</flux:navbar.item>

        <flux:separator vertical variant="subtle" class="my-2"/>
    </flux:navbar>

    <flux:spacer/>

    <flux:navbar class="me-4">
        <flux:navbar.item class="max-lg:hidden" icon="arrow-right-end-on-rectangle" href="/login" label="Log in">Log in</flux:navbar.item>
        <flux:navbar.item class="max-lg:hidden" icon="pencil-square" href="/register" label="Register">Register</flux:navbar.item>
    </flux:navbar>

</flux:header>

<flux:sidebar stashable sticky
              class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <flux:brand href="/" logo="{{ asset('logoipsum-357.png') }}" name="BookList" class="px-2 dark:hidden"/>
    <flux:brand href="/" logo="{{ asset('logoipsum-357.png') }}" name="BookList" class="px-2 hidden dark:flex"/>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="/books" current>Home</flux:navlist.item>
        <flux:navlist.item icon="inbox" href="/books/create">Add a Book</flux:navlist.item>
    </flux:navlist>

    <flux:spacer />

    <flux:navlist variant="outline">
        <flux:navlist.item icon="arrow-right-end-on-rectangle" href="/login">Log in</flux:navlist.item>
        <flux:navlist.item icon="pencil-square" href="/register">Register</flux:navlist.item>
    </flux:navlist>
</flux:sidebar>

<flux:main container>
    {{ $slot }}
</flux:main>

@fluxScripts
</body>
</html>
