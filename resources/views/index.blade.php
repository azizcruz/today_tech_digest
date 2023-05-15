@extends('layouts.guest')

@section('title')
    Today Tech Digest
@endsection

@section('content')
    @fragment('results')
        @if (count($digests) > 0)
            <section class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" id="results">
                @fragment('infinite-scroll-content')
                    @foreach ($digests as $digest)
                        @if ($loop->last && isset($paginationLinks))
                            <div hx-get="{{ $paginationLinks->next_page_url }}&infinite_scroll=1" hx-trigger="intersect"
                                hx-swap="afterend">
                                <x-digest-card digestId="{{ $digest->id }}" imageUrl="{{ $digest->image }}"
                                    category="{{ $digest->category->name }}"
                                    href="{{ route('digest.show', ['slug' => $digest->slug]) }}" title="{!! $digest->title !!}"
                                    page="{{ $paginationLinks->current_page }}" />
                            </div>
                        @else
                            <x-digest-card digestId="{{ $digest->id }}" imageUrl="{{ $digest->image }}"
                                category="{{ $digest->category->name }}"
                                href="{{ route('digest.show', ['slug' => $digest->slug]) }}" title="{!! $digest->title !!}"
                                page="{{ $paginationLinks->current_page }}" />
                        @endif
                    @endforeach
                @endfragment
            </section>
        @else
            <section class="flex justify-center items-center h-52" id="results">
                <p>No results found 🫣</p>
            </section>
        @endif
    @endfragment
    @if (isset($paginationLinks))
        <div class="my-4 htmx-indicator">Loading...</div>
    @endif
@endsection
