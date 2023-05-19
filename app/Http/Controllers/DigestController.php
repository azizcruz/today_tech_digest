<?php

namespace App\Http\Controllers;

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
        }])->whereDate('created_at', today())->paginate(1);


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
            'title' => 'required|string|min:60|max:70|unique:digests',
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

        // dd($imageUrl);

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

        $digest = Digest::with(['Category' => function ($query) {
            return $query->select(['id', 'name']);
        }])->where('slug', $slug)->first();
        $next = $digest->getNext();
        $previous = $digest->getPrevious();

        return view('digest.show', compact('digest', 'previous', 'next'))->fragment($navigate ? 'digest-navigations' : '');
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
            ->orderBy('-created_at');

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
    public function update(UpdateDigestRequest $request, Digest $digest, String $slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Digest $digest)
    {
        //
    }
}
