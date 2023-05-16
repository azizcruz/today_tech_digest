<input type="checkbox" id="my-add-modal" class="modal-toggle" />
<div class="modal" id="add-modal">
    <div class="modal-box relative">
        <form action="">
            <label for="my-add-modal" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">New Digest</h3>
            <label class="label">

            </label>
            <input type="text" placeholder="Title" name="title" class="input input-bordered w-full max-w-full" />
            <label class="label">

            </label>
            <input type="text" placeholder="Meta Description" name="metaDescription"
                class="input input-bordered w-full max-w-full" />

            <label class="label">

            </label>
            <input type="text" placeholder="Keywords" name="keywords"
                class="input input-bordered w-full max-w-full" />

            <div class="form-control mt-4">
                <select class="select  select-bordered w-full max-w-full">
                    <option disabled selected>Category</option>
                    <option value="homer">Homer</option>
                    <option>Marge</option>
                </select>
            </div>

            <div class="form-control">
                <label class="label">

                </label>
                <textarea class="textarea textarea-bordered h-24 w-full" placeholder="Body"></textarea>
            </div>

            <button type="submit"
                class="btn float-right bg-green-500 hover:bg-green-600 mt-2 text-white">Create</button>
        </form>
    </div>
</div>
