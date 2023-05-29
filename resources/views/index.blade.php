@extends('layouts.guest')

@section('meta-tags')
    <!-- Primary Meta Tags -->
    <title>Short Science Articles</title>
    <meta
        name="title"
        content="Short Science Articles ・ Today's Articles"
    >
    <meta
        name="description"
        content="Explore fascinating science articles presented in concise, easy-to-read list points on our website. Stay informed with our latest news updates, delivering the most recent discoveries and breakthroughs in the world of science. Discover intriguing insights and stay ahead in the realm of scientific knowledge. Dive into a captivating collection of science content today."
    >



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
        content="Short Science Articles ・ Today's Articles"
    >
    <meta
        property="og:description"
        content="Explore fascinating science articles presented in concise, easy-to-read list points on our website. Stay informed with our latest news updates, delivering the most recent discoveries and breakthroughs in the world of science. Discover intriguing insights and stay ahead in the realm of scientific knowledge. Dive into a captivating collection of science content today."
    >
    <meta
        property="og:image"
        content="{{ url('/') }}/images/thumbnail.jpg"
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
        content="Short Science Articles ・ Today's Articles"
    >
    <meta
        property="twitter:description"
        content="Explore fascinating science articles presented in concise, easy-to-read list points on our website. Stay informed with our latest news updates, delivering the most recent discoveries and breakthroughs in the world of science. Discover intriguing insights and stay ahead in the realm of scientific knowledge. Dive into a captivating collection of science content today."
    >
    <meta
        property="twitter:image"
        content="{{ url('/') }}/images/thumbnail.jpg"
    >

@section('main')
    @fragment('results')
        @if (count($digests) > 0)
            <section
                class="grid grid-cols-1 md:grid-cols-2 gap-4 my-8"
                id="results"
            >
                @fragment('infinite-scroll-content')
                    @foreach ($digests as $digest)
                        @if ($loop->last && isset($paginationLinks))
                            <div
                                hx-get="{{ $paginationLinks->next_page_url }}&infinite_scroll=1{{ $activeCategory ? '&category=' . $activeCategory . '' : '' }}"
                                hx-trigger="{{ $paginationLinks->total > 12 && $paginationLinks->next_page_url ? 'intersect once' : '' }}"
                                hx-swap="afterend"
                            >
                                <x-digest-card
                                    :digest="$digest"
                                    digestId="{{ $digest->id }}"
                                    imageUrl="{{ $digest->image }}"
                                    category="{{ $digest->category->name }}"
                                    href="{{ route('digest.show', ['slug' => $digest->slug]) }}"
                                    title="{!! $digest->title !!}"
                                    page="{{ isset($paginationLinks) ? $paginationLinks->current_page : '' }}"
                                    is_published="{{ $digest->is_published }}"
                                />
                            </div>
                        @else
                            <x-digest-card
                                :digest="$digest"
                                digestId="{{ $digest->id }}"
                                imageUrl="{{ $digest->image }}"
                                category="{{ $digest->category->name }}"
                                href="{{ route('digest.show', ['slug' => $digest->slug]) }}"
                                title="{!! $digest->title !!}"
                                page="{{ isset($paginationLinks) ? $paginationLinks->current_page : '' }}"
                                is_published="{{ $digest->is_published }}"
                            />
                        @endif
                    @endforeach
                @endfragment
            </section>
        @else
            <section
                class="flex justify-center items-center h-52"
                id="results"
            >
                <p>No results found 🫣</p>
            </section>
        @endif
    @endfragment
    @if (isset($paginationLinks))
        <div class="flex justify-center items-center htmx-indicator">
            <x-loaders.loader></x-loaders.loader>
        </div>
    @endif
@endsection
