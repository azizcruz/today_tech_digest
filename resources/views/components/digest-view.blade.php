@props(['image', 'title', 'created_at', 'category', 'body'])

<article class="mt-4 is-loading-digest loading-digest">
    <img src="/storage/{{ $image }}" alt="{{ $title }} image"
        class="rounded-lg object-cover max-h-[20rem] md:max-h-[20rem] w-full" loading="lazy" />
    <h1 class="text-3xl font-bold text-orange-100 mt-8">
        {{ $title }}
    </h1>
    <div class="my-4 border-t-amber-100"></div>
    <div class="flex justify-between items-center">
        <small>{{ date('m-d-Y', strtotime($created_at)) }}</small>
        <a href="{{ route('home', ['category' => $category]) }}" class="flex items-center justify-center ml-4">
            <span class="text-white mr-2">{{ $category }}</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
            </svg>
        </a>
    </div>
    <div class="my-4 border-t-amber-100"></div>
    <article class="details-page">{{ $body }}</article>
</article>
