@if (request()->route()->getName() === 'home')
    <section class="my-container my-4 flex">
        <input id="search" type="search" placeholder="Search..." name="search" autocomplete="off" value=""
            class="input input-bordered input-md w-full max-w-full pr-12 mr-[-2rem] relative"
            hx-post="{{ route('search-digests') }}" hx-trigger="keyup changed delay:300ms, search" hx-target="#results"
            hx-include-credentials hx-swap="outerHTML"
            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}", "HX-Request": true}' hx-indicator=".search-loading" />

        <button type="button" disabled class="relative right-10 top-[3px] search-loading">
            <x-loaders.loader></x-loaders.loader>
        </button>
    </section>
@endif
