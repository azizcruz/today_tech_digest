@extends('layouts.guest')

@section('title')
    Today Tech Digest
@endsection

@section('content')
    <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach ($digests as $digest)
            <x-digest-card digestId="{{ $digest->id }}" imageUrl="{{ $digest->imageUrl }}"
                category="{{ $digest->category->name }}" href="{{ route('digest.show', ['slug' => $digest->slug]) }}"
                title="{{ $digest->title }}" />
        @endforeach

    </section>
@endsection
