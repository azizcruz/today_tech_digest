<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Requests\StoreDigestRequest;
use App\Http\Requests\UpdateDigestRequest;
use App\Models\Digest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class DigestController extends Controller
{

    /**
     * Display a listing of today resouces.
     */

    public function today(Request $request)
    {
        $validatedData = $request->validate([
            'navigate' => 'nullable|string'
        ]);


        $navigate = $validatedData ? $validatedData['navigate'] : null;

        $todayDigests = Digest::with(['Category' => function ($query) {
            return $query->select(['id', 'name']);
        }])->where('is_published', 1)->whereDate('created_at', today())->paginate(1);


        return view('digest.today', compact('todayDigests'))->fragment($navigate ? 'digest-navigations' : '');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:60|max:85|unique:digests',
            'body' => 'required|string',
            'metaDescription' => 'required|string',
            'category' => 'required|string|exists:categories,id',
            'keywords' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);


        if ($validator->fails()) {
            return view('components.blocks.add-modal', ['errors' => $validator->errors(), 'oldInput' => $request->input()])->fragment('add-digest-modal-content');
        }

        $validatedData = $validator->validated();


        $imageUrl = Storage::putFile('images', $request->file('image'));

        $digest = new Digest;
        $digest->title = $validatedData['title'];
        $digest->body = $validatedData['body'];
        $digest->meta_description = $validatedData['metaDescription'];
        $digest->keywords = $validatedData['keywords'];
        $digest->category_id = $validatedData['category'];
        $digest->slug = Str::slug($validatedData['title']);
        $digest->image = $imageUrl;
        $digest->user_id = $request->user()->id;



        $digest->save();

        return view('components.blocks.add-modal')->with('success', 'Digest Was Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug, Request $request)
    {
        $validatedData = $request->validate([
            'navigate' => 'nullable|string'
        ]);

        $navigate = $validatedData ? $validatedData['navigate'] : null;

        try {
            $digest = Digest::with(['Category:id,name'])->where('slug', $slug)->first();
            $next = $digest->getNext();
            $previous = $digest->getPrevious();

            return view('digest.show', compact('digest', 'previous', 'next',))->fragment($navigate ? 'digest-navigations' : '');
        } catch (\Throwable $th) {
            abort(404);
        }
    }

    /**
     * Search 
     */
    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'search' => 'nullable|string',
        ]);

        $search = $validatedData['search'];



        $digests = Digest::with(['category' => function ($query) {
            return $query->select('id', 'name');
        }])
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'LIKE', '%' . $search . '%');
            })
            ->orderByDesc('created_at');

        $digests = $search ? $digests->get() : $digests->paginate(12)->withPath(route('home'));

        if ($search) {
            // Highlight the search term in the title
            $digests = collect($digests)->map(function ($digest) use ($search) {
                $highlightedTitle = preg_replace("/($search)/i", "<span class='highlight'>$1</span>", $digest->title);
                $digest->title = $highlightedTitle;
                return $digest;
            });
        }

        if (!$search) {
            $paginationLinks = json_decode($digests->toJson());
        } else {
            $paginationLinks = null;
        }

        return view('index', compact('digests', 'search', 'paginationLinks'))->fragment('results');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Digest $slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Digest $digest, Request $request)
    {


        $this->authorize('update', $digest);

        if (!$request->input('image')) {
            $request->merge(['image' => $request->input('image') ?? $digest->image]);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:60|max:70|unique:digests' . ',id,' . $digest->id,
            'body' => 'required|string',
            'meta_description' => 'required|string',
            'category_id' => 'required|string|exists:categories,id',
            'keywords' => 'required|string',
            'image' => [function ($attribute, $value, $fail) use ($request, $digest) {
                if (!$request->hasFile('image') && $digest->image !== $request->input('image')) {
                    $fail($attribute . 'must be a valid image');
                };

                if ($request->hasFile('image')) {
                    $imageUrl = Storage::putFile('images', $request->file('image'));
                    $request->merge(['image' => $imageUrl]);
                }
            }]
        ]);


        $oldInput = $request->input();
        $errors = $validator->errors();


        if ($validator->fails()) {
            return view('components.blocks.edit-modal', compact('oldInput', 'errors', 'digest'))->fragment('edit-digest-modal-content');
        }

        $digest->update($request->input());

        return view('components.blocks.edit-modal', ['digest' => $digest])->with('success', 'Digest Was Updated Successfully')->fragment('edit-digest-modal-content');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        // Delete image
        $digest =  Digest::where('slug', $slug)->get()->first();
        $imageName = str_replace('images/', '', $digest->image);

        if (Storage::delete("images/" . $imageName)) {
            $digest->delete();
        }


        if (!$digest) {
            return view('index')->with('error', 'Does not exist');
        }
        $digests = Digest::queryDigests();

        return 'OK';
    }

    /**
     * To publish unpublish digest
     */
    public function toPublish(Digest $digest, Request $request)

    {

        $validated = $request->validate(['from' => 'required|string']);

        $digest->is_published = $digest->is_published === 1 ? 0 : 1;

        $digest->save();

        if ($validated['from'] === 'card') {
            return view('components.digest-card', compact('digest'))->fragment('publish-section');
        } else {
            return view('components.digest-view', compact('digest'))->fragment('publish-section');
        }
    }


    /**
     * Publish to facebook
     */
    public function publishToFacebook(Digest $digest)
    {
    }


    /**
     * Publish to twitter
     */
    public function publishToTwitter(Digest $digest)
    {
    }
}
