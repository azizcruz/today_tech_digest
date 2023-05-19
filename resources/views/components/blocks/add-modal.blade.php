@fragment('add-digest-modal-content')
    <section id="add-digest-wrapper">
        <input type="checkbox" x-model="toggleAddModal" id="my-add-modal" class="modal-toggle" />


        @if ($message = Session::get('success'))
            <p class="my-4 bg-green-500 text-white p-4">{{ $message }}</p>
        @endif

        <div class="modal" id="add-modal">

            <div class="modal-box relative">
                <button for="my-add-modal" x-on:click="toggleAddModal = false"
                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</button>
                <form id="add-digest-form" hx-post="{{ route('digest.store') }}" x-data="{ title: '' }"
                    hx-target="#add-digest-wrapper" hx-swap="outerHTML" enctype="multipart/form-data">
                    @csrf


                    <h3 class="text-lg font-bold mb-4">New Digest</h3>
                    <input type="text" placeholder="Title" name="title" class="input input-bordered w-full max-w-full"
                        value="{{ $oldInput['title'] ?? '' }}" x-model="title" />
                    <label class="label text-red-500">
                        <span x-text="title.length"></span>
                        {{ $errors->first('title') }}
                    </label>
                    <input type="text" placeholder="Meta Description" name="metaDescription"
                        class="input input-bordered w-full max-w-full" value="{{ $oldInput['metaDescription'] ?? '' }}" />

                    <label class="label text-red-500">
                        {{ $errors->first('metaDescription') }}
                    </label>
                    <input type="text" placeholder="Keywords" name="keywords"
                        class="input input-bordered w-full max-w-full" value="{{ $oldInput['keywords'] ?? '' }}" />

                    <label class="label text-red-500">
                        {{ $errors->first('keywords') }}
                    </label>

                    <div class="form-control mt-4">
                        <select class="select select-bordered w-full max-w-full" name="category">
                            <option disabled {{ !$errors->has('category') ? 'selected' : '' }} value="">Category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ ($oldInput['category'] ?? false) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>
                        <label class="label text-red-500">
                            {{ $errors->first('category') }}
                        </label>
                    </div>

                    <div class="form-control w-full mt-6">
                        <input type="file" class="file-input file-input-bordered w-full" name="image" />
                        <label class="label text-red-500">
                            {{ $errors->first('image') }}
                        </label>
                    </div>

                    <div class="form-control">
                        <textarea class="textarea textarea-bordered h-24 w-full" placeholder="Body" name="body">{{ $oldInput['body'] ?? '' }}</textarea>
                        <label class="label">
                            <label class="text-red-500">
                                {{ $errors->first('body') }}
                            </label>
                        </label>
                    </div>

                    <button type="submit"
                        class="btn float-right bg-green-500 hover:bg-green-600 mt-2 text-white">Create</button>
                </form>
            </div>
        </div>
    </section>
@endfragment
