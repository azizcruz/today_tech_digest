@extends('layouts.guest')

@section('meta-tags')
    <!-- Primary Meta Tags -->
    <title>Short Science Articles ・ {{ $digest->title }}</title>
    <meta
        name="title"
        content="{{ $digest->title }}"
    >
    <meta
        name="description"
        content="{{ Str::limit($digest->meta_description) }}"
    >
    <meta
        name="keywords"
        content="{{ $digest->keywords }}"
    />


    <!-- Open Graph / Facebook -->
    <meta
        property="og:type"
        content="website"
    >
    <meta
        property="og:url"
        content="{{ Request::url() }}"
    >
    <meta
        property="og:title"
        content="{{ $digest->title }}"
    >
    <meta
        property="og:description"
        content="{{ Str::limit($digest->meta_description) }}"
    >
    <meta
        property="og:image"
        content="{{ url('/') }}/storage/{{ $digest->image }}"
    >

    <!-- Twitter -->
    <meta
        property="twitter:card"
        content="summary_large_image"
    >
    <meta
        property="twitter:url"
        content="{{ Request::url() }}"
    >
    <meta
        property="twitter:title"
        content="{{ $digest->title }}"
    >
    <meta
        property="twitter:description"
        content="{{ $digest->meta_description }}"
    >
    <meta
        property="twitter:image"
        content="{{ url('/') }}/storage/{{ $digest->image }}"
    >
@endsection

@section('main')
    <section class="mt-24">
        <div class="flex justify-end items-center">

            <a
                href="/?page={{ Request::query('page') }}#{{ Request::query('id') }}"
                class="btn"
            > <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5 mr-2 mb-[1px]"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"
                    />
                </svg>
                Back</a>
        </div>
        @fragment('digest-navigations')
            <div id="digest-navigation">
                <div class="is-loading-icon loading-digest">
                    <div class="flex justify-center items-center h-[40rem]">
                        <x-loaders.loader></x-loaders.loader>
                    </div>
                </div>
                <x-digest-view
                    :digest="$digest"
                    image="{{ $digest->image }}"
                    title="{{ $digest->title }}"
                    created_at="{{ $digest->created_at }}"
                    category="{{ $digest->category->name }}"
                    body="{{ $digest->body }}"
                >
                </x-digest-view>

                <div>
                    <div class="btn-group grid grid-cols-2 mt-6">
                        <x-navigation-button
                            url="{{ $previous ? route('digest.show', ['slug' => $previous->slug, 'navigate' => '1']) : '' }}"
                            title="Previous"
                            classes="btn btn-outline {{ $previous ? '' : 'pointer-events-none opacity-50' }}"
                        >
                        </x-navigation-button>

                        <x-navigation-button
                            url="{{ $next ? route('digest.show', ['slug' => $next->slug, 'navigate' => '1']) : '' }}"
                            title="Next"
                            classes="btn btn-outline {{ $next ? '' : 'pointer-events-none opacity-50' }}"
                        >
                        </x-navigation-button>
                    </div>
                </div>
            </div>
        @endfragment
    </section>
@endsection
