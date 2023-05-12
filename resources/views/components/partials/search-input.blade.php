@if (request()->route()->getName() === 'home')
    <section class="my-container my-4 flex">
        <input type="search" placeholder="Search..." name="search" autocomplete="off" value=""
            class="input input-bordered input-md w-full max-w-full pr-12 mr-[-2rem] relative"
            hx-post="{{ route('search-digests') }}" hx-trigger="keyup changed delay:500ms, search"
            hx-target="#digests-list" hx-indicator=".htmx-indicator" hx-include-credentials hx-swap="outerHTML"
            hx-headers='{"X-CSRF-TOKEN": "{{ csrf_token() }}", "HX-Request": true}' />

        <button type="submit" class="relative right-10 top-[3px] htmx-indicator">
            <div class="loader"></div>
        </button>
    </section>
@endif
