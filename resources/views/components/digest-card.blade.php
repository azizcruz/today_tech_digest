@props(['digestId', 'imageUrl', 'href', 'category', 'title', 'page'])

<section class="relative rounded-lg overflow-hidden h-64 md:h-[25em]" id="{{ $digestId }}">
    <img id="card-background" class="absolute h-full w-full object-cover" src="/storage/{{ $imageUrl }}"
        alt="Card Background" loading="lazy" />
    <div class="absolute inset-0 bg-gray-800 bg-opacity-60"></div>
    <div class="absolute inset-0 flex justify-center items-center">
        <div class="text-center">
            <h2 class="text-xl font-bold text-white mb-2 px-8">{!! $title !!}</h2>
            <a href="{{ $href }}?id={{ $digestId }}{{ isset($page) ? '&page=' . $page : '' }}"
                class="btn btn-sm font-bold">Quick Read</a>
        </div>
    </div>
    <section class="absolute bottom-6 right-6 flex justify-between w-20">
        {{-- Admin --}}
        <label for="my-edit-modal" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 text-grey-400">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
        </label>
        <a href="">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="text-grey-400">
                <path
                    d="M9.19795 21.5H13.198V13.4901H16.8021L17.198 9.50977H13.198V7.5C13.198 6.94772 13.6457 6.5 14.198 6.5H17.198V2.5H14.198C11.4365 2.5 9.19795 4.73858 9.19795 7.5V9.50977H7.19795L6.80206 13.4901H9.19795V21.5Z"
                    fill="currentColor" />
            </svg>
        </a>
        <a href="">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
                class="text-grey-400">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M8 3C9.10457 3 10 3.89543 10 5V8H16C17.1046 8 18 8.89543 18 10C18 11.1046 17.1046 12 16 12H10V14C10 15.6569 11.3431 17 13 17H16C17.1046 17 18 17.8954 18 19C18 20.1046 17.1046 21 16 21H13C9.13401 21 6 17.866 6 14V5C6 3.89543 6.89543 3 8 3Z"
                    fill="currentColor" />
            </svg>
        </a>

        <a href="">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
            </svg>
        </a>
        {{-- Admin --}}
    </section>
    <a href="{{ route('home', ['category' => $category]) }}" class="absolute bottom-6 left-6 flex items-center">
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
