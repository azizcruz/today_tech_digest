@extends('layouts.guest')

@section('title')
    Today Tech Digest
@endsection

@section('content')
    <section class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-digest-card digestId="1" imageUrl="https://placehold.co/600x600" category="Tech" href=""
            title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit, veniam." />
        <x-digest-card digestId="1" imageUrl="https://placehold.co/600x600" category="Tech" href=""
            title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, qui officia. Consequatur, quod. Officiis, qui" />
        <x-digest-card digestId="1" imageUrl="https://placehold.co/600x600" category="Tech" href=""
            title="Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium, qui officia. Consequatur, quod. Officiis, qui" />
    </section>
@endsection
