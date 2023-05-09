<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="night">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    @yield('meta-tags')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer drawer-end">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            @include('components/partials/header')
            @include('components/partials/search-input')
            <main class="my-container min-h-screen">
                @yield('content')
            </main>
            @include('components/partials/footer')
        </div>
        <div class="drawer-side">
            <label for="my-drawer-4" class="drawer-overlay"></label>
            <ul class="menu p-4 w-[80%] sm:w-80 bg-base-100 text-base-content">
                <!-- Sidebar content here -->
                <li class="my-1">
                    Category
                    {{-- <Link :href="`/?category=${category.name}`"
                        :class="[
                            page.props.categoryPresented === category.name &&
                            'active',
                        ]">
                    {{ category . name }}</Link>
                </li> --}}
            </ul>
        </div>
    </div>
</body>

</html>
