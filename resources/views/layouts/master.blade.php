<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-theme="night"
>

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{ asset('images/apple-touch-icon.png') }}"
    >
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('images/favicon-32x32.png') }}"
    >
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{ asset('images/favicon-16x16.png') }}"
    >
    <link
        rel="manifest"
        href="/site.webmanifest"
    >
    <link
        rel="mask-icon"
        href="/safari-pinned-tab.svg"
        color="#0c1322"
    >
    <meta
        name="msapplication-TileColor"
        content="#da532c"
    >
    <meta
        name="theme-color"
        content="#ffffff"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>@yield('title')</title>

    @yield('meta-tags')
    <!-- Fonts -->
    <link
        rel="preconnect"
        href="https://fonts.bunny.net"
    >
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script
        src="https://unpkg.com/htmx.org@1.9.2"
        integrity="sha384-L6OqL9pRWyyFU3+/bjdSri+iIphTN/bvYyM37tICVyOJkWZLpP2vGn6VUEXgzg6h"
        crossorigin="anonymous"
    ></script>
    <script>
        document.addEventListener('htmx:afterSwap', function(event) {
            var myElement = document.querySelector('.message');
            setTimeout(() => {
                myElement.classList.add('hidden');
            }, 1000);
        });
    </script>
</head>

<body>
    @yield('content')




</body>

</html>
