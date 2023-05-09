@extends('layouts.guest')

@section('title')
    Today Digests
@endsection

@section('content')
    <section>

        <h3 class="text-2xl text-center font-bold mt-4">Today's Digests</h3>
        <p class="text-center max-w-md mx-auto text-sm opacity-60">
            Stay up-to-date with our latest curated collection of today's top tech
            news and insights
        </p>

        <div class="flex justify-between items-center">
            <a href="" aria-disabled="false" class="btn btn-sm text-xs !text-blue-200">
                First
            </a>
            <button class="btn mx-auto !text-blue-200" disabled>1/8</button>
            <a href="" aria-disabled="false" class="btn btn-sm text-xs !text-blue-200">
                Last
            </a>
        </div>

        <article class="mt-4">
            <img src="https://placehold.co/600x400" alt=""
                class="rounded-lg object-cover max-h-[20rem] md:max-h-[20rem] w-full" loading="lazy" />
            <h1 class="text-3xl font-bold text-orange-100 mt-8">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis,
                excepturi?
            </h1>
            <div class="my-4 border-t-amber-100"></div>
            <div class="flex justify-between items-center">
                <small>22-05-2022</small>
                <div v-if="true" class="flex items-center justify-center ml-4">
                    <span class="text-white mr-2">Tech</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                </div>
            </div>
            <div class="my-4 border-t-amber-100"></div>
            <article
                v-html="
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Non excepturi sed accusantium magni expedita iure natus est ab nostrum inventore, quam a sint totam dicta assumenda reiciendis quia ducimus voluptate!'
            "
                class="details-page" />
        </article>
        <div>
            <div class="btn-group grid grid-cols-2 mt-6">
                <button href="" aria-disabled="false" class="btn btn-outline">Previous</button>
                <button href="" aria-disabled="false" class="btn btn-outline">Next</button>
            </div>
        </div>
    </section>
@endsection
