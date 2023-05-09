<header class="navbar bg-base-100 my-container justify-center">
    <div class="flex flex-col md:flex-row md:flex-1">
        <a href="{{ route('home') }}" class="normal-case text-xl">
            <img src="{{ asset('images/logo.png') }}" alt="today tech digest logo" width="200" />
        </a>
        <div class="w-full mt-2 md:mt-0">
            <nav class="flex flex-wrap justify-center md:justify-end gap-2">
                <a href="{{ route('home') }}" class="btn btn-sm btn-primary normal-case">View All Tech Digests</a>
                <a href="{{ route('digest.today') }}" class="btn btn-sm btn-primary normal-case">Today's
                    Digests</a>
                <label for="my-drawer-4" class="drawer-button btn btn-sm btn-primary normal-case">Browse by
                    Category</label>
            </nav>
        </div>
    </div>
</header>
