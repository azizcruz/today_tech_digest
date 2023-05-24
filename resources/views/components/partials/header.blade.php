<div class="navbar bg-base-300 mb-3 absolute z-50">
    <div class="navbar-start">
        <div class="dropdown">
            <label
                tabindex="0"
                class="btn btn-ghost btn-circle"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h7"
                    />
                </svg>
            </label>
            <ul
                tabindex="0"
                class="menu menu-compact bg-base-300 dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
            >
                <li>
                    <a
                        href="{{ route('digest.today') }}"
                        class="font-bold md:hidden normal-case flex-shrink"
                    >Today's
                        Digests</a>
                </li>
                <div class="divider md:hidden"></div>
                <li><a
                        class="flex-grow flex-shrink"
                        href="{{ route('about-us') }}"
                    >About us</a></li>
                <li><a
                        class="flex-grow flex-shrink"
                        href="{{ route('contact-us') }}"
                    >Contact</a></li>
                <li><a
                        class="flex-grow flex-shrink"
                        href="{{ route('privacy-policy') }}"
                    >Privacy Policy</a>
                </li>
                <li><a
                        class="flex-grow flex-shrink"
                        href="{{ route('terms-and-conditions') }}"
                    >Terms &
                        Conditions</a>
                </li>


            </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a
            href="{{ route('home') }}"
            class="normal-case text-xl mr-4"
        >
            <img
                src="{{ asset('images/logo.png') }}"
                alt="today tech digest logo"
                width="200"
            />
        </a>
    </div>
    <div
        class="navbar-end"
        x-data="{ toggleAddModal: false, toggleEditModal: false }"
    >
        <div class="hidden md:flex flex-wrap">
            {{-- Admin --}}
            <x-blocks.add-modal></x-blocks.add-modal>
            @auth
                <!-- Authentication -->
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="inline"
                >
                    @csrf
                    <button
                        class="btn btn-sm bg-transparent border-none"
                        onclick="event.preventDefault();
                                this.closest('form').submit();"
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
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"
                            />
                        </svg>
                    </button>
                </form>
                <button
                    class="bg-green-800 hover:bg-green-600 text-white btn btn-sm normal-case mr-1"
                    x-on:click="toggleAddModal = true"
                >
                    Digest <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-4 h-4 ml-1"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 4.5v15m7.5-7.5h-15"
                        />
                    </svg>
                </button>
            @endauth
            {{-- Admin --}}


            <button class="btn btn-sm btn-primary normal-case flex-shrink mr-1">
                <a
                    href="{{ route('digest.today') }}"
                    class="font-bold normal-case flex-shrink"
                >Today's
                    Digests</a></button>
            <label
                for="my-drawer-4"
                class="drawer-button btn btn-sm btn-primary normal-case flex-shrink"
            >
                by Category</label>
        </div>
        <div class="md:hidden">
            <label
                for="my-drawer-4"
                class="btn btn-ghost btn-circle"
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
                        d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 6h.008v.008H6V6z"
                    />
                </svg>
            </label>
        </div>
    </div>
</div>
