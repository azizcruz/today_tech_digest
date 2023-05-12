<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDigestRequest;
use App\Http\Requests\UpdateDigestRequest;
use App\Models\Digest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DigestController extends Controller
{

    /**
     * Display a listing of today resouces.
     */

    public function today()
    {
        $todayDigests = Digest::with(['Category' => function ($query) {
            return $query->select(['id', 'name']);
        }])->whereDate('created_at', today())->paginate(1)->toArray();

        return view('digest.today', compact('todayDigests'));
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
    public function store(StoreDigestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $digest = Digest::with(['Category' => function ($query) {
            return $query->select(['id', 'name']);
        }])->where('slug', $slug)->first();
        $next = $digest->getNext();
        $previous = $digest->getPrevious();
        return view('digest.show', compact('digest', 'previous', 'next'));
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

        $digests = $search ? $digests->get() : $digests->simplePaginate(12);

        if ($search) {
            // Highlight the search term in the title
            $digests = collect($digests)->map(function ($digest) use ($search) {
                $highlightedTitle = str_replace($search, "<span class='highlight'>$search</span>", $digest->title);
                $digest->title = $highlightedTitle;
                return $digest;
            });
        }


        return view('index', compact('digests', 'search'))->fragment('search-results');
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
    public function update(UpdateDigestRequest $request, Digest $digest)
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
