@extends('layouts.guest')

@section('title')
@endsection

@section('content')
    <section>
        <div class="flex justify-end items-center">

            <a href="/#{{ Request::query('id') }}" class="btn"> <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2 mb-[1px]">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
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
                <article class="mt-4 is-loading-digest loading-digest">
                    <img src="/storage/{{ $digest->image }}" alt=""
                        class="rounded-lg object-cover max-h-[20rem] md:max-h-[20rem] w-full" loading="lazy" />
                    <h1 class="text-3xl font-bold text-orange-100 mt-8">
                        {{ $digest->title }}
                    </h1>
                    <div class="my-4 border-t-amber-100"></div>
                    <div class="flex justify-between items-center">
                        <small>{{ date('m-d-Y', strtotime($digest->created_at)) }}</small>
                        <div v-if="true" class="flex items-center justify-center ml-4">
                            <span class="text-white mr-2">{{ $digest->category->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                    </div>
                    <div class="my-4 border-t-amber-100"></div>
                    <article class="details-page">{{ $digest->body }}</article>
                </article>
                <div>
                    <div class="btn-group grid grid-cols-2 mt-6">
                        <x-navigation-button
                            url="{{ $previous ? route('digest.show', ['slug' => $previous->slug, 'navigate' => '1']) : '' }}"
                            title="Previous" classes="btn btn-outline {{ $previous ? '' : 'pointer-events-none opacity-50' }}">
                        </x-navigation-button>

                        <x-navigation-button
                            url="{{ $next ? route('digest.show', ['slug' => $next->slug, 'navigate' => '1']) : '' }}"
                            title="Next" classes="btn btn-outline {{ $next ? '' : 'pointer-events-none opacity-50' }}">
                        </x-navigation-button>
                    </div>
                </div>
            </div>
        @endfragment
    </section>
@endsection
