@props(['digest'])

{{-- Admin --}}
@can('create-digest', $digest)
    <section x-data="{ toggleEditModal: false }">

        <div class="flex justify-around my-4 items-center">
            <x-blocks.edit-modal :digest="$digest"></x-blocks.edit-modal>
            <a href="">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="text-grey-400"
                >
                    <path
                        d="M9.19795 21.5H13.198V13.4901H16.8021L17.198 9.50977H13.198V7.5C13.198 6.94772 13.6457 6.5 14.198 6.5H17.198V2.5H14.198C11.4365 2.5 9.19795 4.73858 9.19795 7.5V9.50977H7.19795L6.80206 13.4901H9.19795V21.5Z"
                        fill="currentColor"
                    />
                </svg>
            </a>
            <a href="">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="text-grey-400"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8 3C9.10457 3 10 3.89543 10 5V8H16C17.1046 8 18 8.89543 18 10C18 11.1046 17.1046 12 16 12H10V14C10 15.6569 11.3431 17 13 17H16C17.1046 17 18 17.8954 18 19C18 20.1046 17.1046 21 16 21H13C9.13401 21 6 17.866 6 14V5C6 3.89543 6.89543 3 8 3Z"
                        fill="currentColor"
                    />
                </svg>
            </a>
            <x-publish-unpublish :digest="$digest"></x-publish-unpublish>
            <label
                for="confirm-delete"
                class="btn bg-red-400 hover:bg-red-500 text-white"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                    />
                </svg>
            </label>
            <!-- Put this part before </body> tag -->
            <input
                type="checkbox"
                id="confirm-delete"
                class="modal-toggle"
            />
            <label
                for="confirm-delete"
                class="modal cursor-pointer"
            >
                <label
                    class="modal-box relative"
                    for=""
                >
                    <h3 class="text-lg font-bold">Are you sure about your action!</h3>
                    <form hx-delete="{{ route('digest.destroy', ['slug' => $digest->slug]) }}">
                        @csrf
                        <button
                            type="submit"
                            class="btn bg-red-400 text-white hover:bg-red-500 float-right mt-4"
                        >Yes</button>
                    </form>
                </label>
            </label>
        </div>
    </section>
@endcan
{{-- Admin --}}
<article class="mt-4 is-loading-digest loading-digest">
    <img
        src="/storage/{{ $digest->image }}"
        alt="{{ $digest->title }} image"
        class="rounded-lg object-cover max-h-[20rem] md:max-h-[20rem] w-full"
        loading="lazy"
    />
    <h1 class="text-3xl font-bold text-orange-100 mt-8 w-full break-words">
        {{ $digest->title }}
    </h1>
    <div class="my-4 border-t-amber-100"></div>
    <div class="flex justify-between items-center">
        <small>{{ date('m-d-Y', strtotime($digest->created_at)) }}</small>
        <a
            href="{{ route('home', ['category' => $digest->category->name]) }}"
            class="flex items-center justify-center ml-4"
        >
            <span class="text-white mr-2">{{ $digest->category->name }}</span>
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
                    d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                />
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 6h.008v.008H6V6z"
                />
            </svg>
        </a>
    </div>
    <div class="my-4 border-t-amber-100"></div>
    <article class="details-page">{{ $digest->body }}</article>
</article>
