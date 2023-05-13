@extends('layouts.guest')

@section('title')
    Today Digests
@endsection



@section('content')
    @if (count($todayDigests['data']) > 0)
        @foreach ($todayDigests['data'] as $digest)
            <section>
                <h3 class="text-2xl text-center font-bold mt-4">Today's Digests</h3>
                <p class="text-center max-w-md mx-auto text-sm opacity-60">
                    Stay up-to-date with our latest curated collection of today's top tech
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

                            <x-navigation-button url="{{ $todayDigests['first_page_url'] }}&navigate=1" title="First"
                                classes="btn btn-sm text-xs !text-blue-200 {{ $todayDigests['current_page'] != 1 ? '' : 'pointer-events-none opacity-50' }}">
                            </x-navigation-button>
                            <button class="btn mx-auto !text-blue-200"
                                disabled>{{ $todayDigests['current_page'] }}/{{ $todayDigests['total'] }}</button>
                            <x-navigation-button url="{{ $todayDigests['last_page_url'] }}&navigate=1" title="Last"
                                classes="btn btn-sm text-xs !text-blue-200 {{ $todayDigests['current_page'] !== $todayDigests['total'] ? '' : 'pointer-events-none opacity-50' }}">
                            </x-navigation-button>

                        </div>

                        <article class="mt-4">
                            <img src="/storage/{{ $digest['image'] }}" alt="{{ $digest['title'] }}"
                                class="rounded-lg object-cover max-h-[20rem] md:max-h-[20rem] w-full" loading="lazy" />
                            <h1 class="text-3xl font-bold text-orange-100 mt-8">
                                {{ $digest['title'] }}
                            </h1>
                            <div class="my-4 border-t-amber-100"></div>
                            <div class="flex justify-between items-center">
                                <small>{{ date('m-d-Y', strtotime($digest['created_at'])) }}</small>
                                <div v-if="true" class="flex items-center justify-center ml-4">
                                    <span class="text-white mr-2">{{ $digest['category']['name'] }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="my-4 border-t-amber-100"></div>
                            <article class="details-page">{{ $digest['body'] }}</article>
                        </article>
                        <div>
                            <div class="btn-group grid grid-cols-2 mt-6">
                                <x-navigation-button url="{{ $todayDigests['prev_page_url'] }}&navigate=1" title="Previous"
                                    classes="btn btn-outline {{ $todayDigests['prev_page_url'] ? '' : 'pointer-events-none opacity-50' }}">
                                </x-navigation-button>

                                <x-navigation-button url="{{ $todayDigests['next_page_url'] }}&navigate=1" title="Next"
                                    classes="btn btn-outline {{ $todayDigests['next_page_url'] ? '' : 'pointer-events-none opacity-50' }}">
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
