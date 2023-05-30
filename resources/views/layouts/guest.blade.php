@extends('layouts.master')

@section('content')
    <div class="drawer drawer-end">
        <input
            id="my-drawer-4"
            type="checkbox"
            class="drawer-toggle"
        />
        <div class="drawer-content">
            <!-- Page content here -->
            @include('components/partials/header')
            @include('components/partials/search-input')
            <main class="my-container min-h-screen">
                @yield('main')
            </main>
            @include('components/partials/footer')
        </div>
        <div class="drawer-side">
            <label
                for="my-drawer-4"
                class="drawer-overlay"
            ></label>
            <ul class="menu p-4 w-[80%] sm:w-80 bg-base-100 text-base-content">
                <!-- Sidebar content here -->
                <li>
                    <a
                        href="{{ route('home') }}"
                        class="{{ request()->route()->getName === 'home' ? 'active' : '' }}"
                    >All</a>
                </li>
                @foreach ($categories as $category)
                    <li class="my-1">
                        <a
                            href="/?category={{ $category->name }}"
                            class="{{ isset($activeCategory) && $activeCategory === $category->name ? 'active' : '' }}"
                        >
                            {{ $category->name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
@endsection
