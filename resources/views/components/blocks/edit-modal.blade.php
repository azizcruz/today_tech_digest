@props(['digest'])

@fragment('edit-digest-modal-content')
    <section id="edit-digest-wrapper">
        <input
            type="checkbox"
            x-model="toggleEditModal"
            id="my-edit-modal"
            class="modal-toggle"
        />
        <div
            class="modal"
            :class="{ 'modal-open': toggleEditModal }"
            id="edit-modal"
        >
            <div class="modal-box relative">
                @if (!empty($success))
                    <p class="bg-green-500 text-white p-2 mb-2 message">
                        {{ $success }}
                    </p>
                @endif
                <form
                    id="edit-digest-form"
                    hx-post="{{ route('digest.update', $digest) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    hx-swap="outerHTML"
                    hx-target="#edit-digest-wrapper"
                >

                    @if (session()->has('success'))
                        <p class="my-4 bg-green-500 text-white p-4">{{ session('success') }}</p>
                    @endif

                    @csrf
                    @method('patch')

                    <label
                        for="my-edit-modal-{{ $digest->id }}"
                        class="btn btn-sm btn-circle absolute right-2 top-2"
                        x-on:click="toggleEditModal = false"
                    >✕</label>
                    <h3 class="text-lg font-bold">Edit Digest</h3>
                    <input
                        type="text"
                        placeholder="Title"
                        name="title"
                        class="input input-bordered w-full max-w-full"
                        value="{{ $oldInput['title'] ?? $digest->title }}"
                    />
                    <label class="label text-red-500">
                        {{ $errors->first('title') }}
                    </label>
                    <input
                        type="text"
                        placeholder="Meta Description"
                        name="meta_description"
                        class="input input-bordered w-full max-w-full"
                        value="{{ $oldInput['meta_description'] ?? $digest->meta_description }}"
                    />


                    <label class="label text-red-500">
                        {{ $errors->first('metaDescription') }}
                    </label>
                    <input
                        type="text"
                        placeholder="Keywords"
                        name="keywords"
                        class="input input-bordered w-full max-w-full"
                        value="{{ $oldInput['keywords'] ?? $digest->keywords }}"
                    />

                    <div class="form-control mt-4">
                        <select
                            class="select  select-bordered w-full max-w-full"
                            name="category_id"
                        >
                            @foreach ($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ (($oldInput ?? false) && $oldInput['category_id'] === $category->id) || $digest->category_id === $category->id ? 'selected' : '' }}
                                >{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label class="label text-red-500">
                            {{ $errors->first('category') }}
                        </label>
                    </div>

                    <div class="form-control w-full mt-6">
                        <input
                            type="file"
                            class="file-input file-input-bordered w-full"
                            name="image"
                        />
                        <label class="label text-red-500">
                            {{ $errors->first('image') }}
                        </label>
                    </div>

                    <div class="form-control">
                        <textarea
                            class="textarea textarea-bordered h-24 w-full"
                            placeholder="Body"
                            name="body"
                        >{{ $oldInput['body'] ?? $digest->body }}</textarea>
                        <label class="label text-red-500">
                            {{ $errors->first('body') }}
                        </label>
                    </div>

                    <button
                        type="submit"
                        class="btn float-right bg-green-500 hover:bg-green-600 mt-2 text-white"
                    >Edit</button>
                </form>
            </div>
        </div>
        <label
            x-on:click="toggleEditModal = true"
            class="cursor-pointer"
        >


            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-6 h-6 text-grey-400"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                />
            </svg>
        </label>
    </section>
@endfragment
