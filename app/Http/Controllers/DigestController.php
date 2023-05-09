<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDigestRequest;
use App\Http\Requests\UpdateDigestRequest;
use App\Models\Digest;

class DigestController extends Controller
{

    /**
     * Display a listing of today resouces.
     */

    public function today()
    {
        return view('digest.today', ['msg' => 'today digests']);
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
    public function show(Digest $digest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Digest $digest)
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
