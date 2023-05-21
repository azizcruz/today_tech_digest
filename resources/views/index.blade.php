@extends('layouts.guest')

@section('title')
    Today Tech Digest
@endsection

@section('main')
    @fragment('results')
        @if (count($digests) > 0)
            <section
                class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"
                id="results"
            >
                @fragment('infinite-scroll-content')
                    @foreach ($digests as $digest)
                        @if ($loop->last && isset($paginationLinks))
                            <div
                                hx-get="{{ $paginationLinks->next_page_url }}&infinite_scroll=1"
                                hx-trigger="{{ $paginationLinks->total > 12 ? 'intersect once' : '' }}"
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
        <div class="my-4 htmx-indicator">Loading...</div>
    @endif
@endsection
