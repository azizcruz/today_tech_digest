@extends('layouts.guest')

@section('meta-tags')
    <!-- Primary Meta Tags -->
    <title>Short Science Articles ・ Today's Articles</title>
    <meta
        name="title"
        content="Short Science Articles ・ Today's Articles"
    >
    <meta
        name="description"
        content="Stay up-to-date with our latest curated collection of today's top science short
        news and insights"
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
        content="Stay up-to-date with our latest curated collection of today's top science
        news and insights"
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
        content="Stay up-to-date with our latest curated collection of today's top science
        news and insights"
    >
    <meta
        property="twitter:image"
        content="{{ url('/') }}/images/thumbnail.jpg"
    >
@endsection


@section('main')
    @if (count($todayDigests) > 0)
        @foreach ($todayDigests as $digest)
            <section class="mt-24">
                <h3 class="text-2xl text-center font-bold mt-4">Today's Digests</h3>
                <p class="text-center max-w-md mx-auto text-sm opacity-60">
                    Stay up-to-date with our latest curated collection of today's top science
                    news and insights
                </p>
                @fragment('digest-navigations')
                    <div id="digest-navigation">
                        <div class="is-loading-icon loading-digest">
                            <div class="flex justify-center items-center h-[40rem]">
                                <x-loaders.loader></x-loaders.loader>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">

                            <x-navigation-button
                                url="{{ $todayDigests->url(1) }}&navigate=1"
                                title="First"
                                classes="btn btn-sm text-xs !text-blue-200 {{ $todayDigests->currentPage() != 1 ? '' : 'pointer-events-none opacity-50' }}"
                            >
                            </x-navigation-button>
                            <button
                                class="btn mx-auto !text-blue-200"
                                disabled
                            >{{ $todayDigests->currentPage() }}/{{ $todayDigests->total() }}</button>
                            <x-navigation-button
                                url="{{ $todayDigests->url($todayDigests->lastPage()) }}&navigate=1"
                                title="Last"
                                classes="btn btn-sm text-xs !text-blue-200 {{ $todayDigests->currentPage() !== $todayDigests->total() ? '' : 'pointer-events-none opacity-50' }}"
                            >
                            </x-navigation-button>

                        </div>
                        <x-digest-view
                            :digest="$digest"
                            image="{{ $digest->image }}"
                            title="{{ $digest->title }}"
                            created_at="{{ $digest->created_at }}"
                            category="{{ $digest->category->name }}"
                            body="{{ $digest->body }}"
                        ></x-digest-view>


                        </article>
                        <div>
                            <div class="btn-group grid grid-cols-2 mt-6">
                                <x-navigation-button
                                    url="{{ $todayDigests->previousPageUrl() }}&navigate=1"
                                    title="Previous"
                                    classes="btn btn-outline {{ $todayDigests->previousPageUrl() ? '' : 'pointer-events-none opacity-50' }}"
                                >
                                </x-navigation-button>

                                <x-navigation-button
                                    url="{{ $todayDigests->nextPageUrl() }}&navigate=1"
                                    title="Next"
                                    classes="btn btn-outline {{ $todayDigests->nextPageUrl() ? '' : 'pointer-events-none opacity-50' }}"
                                >
                                </x-navigation-button>

                            </div>
                        </div>
                    </div>
                @endfragment
            </section>
        @endforeach
    @else
        <section class="flex h-52 justify-center items-center">
            <p>The digests are coming, stay tuned 😉</p>
        </section>
    @endif
@endsection
