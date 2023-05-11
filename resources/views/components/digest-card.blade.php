@props(['digestId', 'imageUrl', 'href', 'category', 'title'])

<section class="relative rounded-lg overflow-hidden h-64 md:h-[25em]" id="{{ $digestId }}">
    <img id="card-background" class="absolute h-full w-full object-cover" src="/storage/{{ $imageUrl }}"
        alt="Card Background" loading="lazy" />
    <div class="absolute inset-0 bg-gray-800 bg-opacity-60"></div>
    <div class="absolute inset-0 flex justify-center items-center">
        <div class="text-center">
            <h2 class="text-xl font-bold text-white mb-2 px-8">{!! $title !!}</h2>
            <a href="{{ $href }}?id={{ $digestId }}" class="btn btn-sm font-bold">Quick Read</a>
        </div>
    </div>
    <a href="" class="absolute bottom-6 left-6 flex items-center">
        <span class="text-white mr-1 font-bold text-sm md:text-md">{{ $category }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 h-4 md:w-5 md:h-5 text-white">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z"></path>
        </svg>
    </a>

    <!-- <button
    disabled
    class="btn btn-ghost absolute bottom-0 right-0 z-10 flex items-center justify-center mr-4 mb-4 mt-5"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0 24 24"
      stroke-width="1.5"
      stroke="currentColor"
      class="w-6 h-6 text-white"
    >
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"
      ></path>
      <path
        stroke-linecap="round"
        stroke-linejoin="round"
        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    <span class="text-white ml-1">15</span>
  </button> -->
</section>
