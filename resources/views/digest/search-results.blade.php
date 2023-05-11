@if (count($digests) > 0)
    <section class="grid grid-cols-1 md:grid-cols-2 gap-4" id="digests-list">
        @foreach ($digests as $digest)
            <x-digest-card digestId="{{ $digest->id }}" imageUrl="{{ $digest->image }}"
                category="{{ $digest->category->name }}" href="{{ route('digest.show', ['slug' => $digest->slug]) }}"
                title="{{ $digest->title }}" />
        @endforeach
    </section>
@else
    <section class="flex justify-center items-center h-52" id="digests-list">
        <p>No results found 🫣</p>
    </section>
@endif
