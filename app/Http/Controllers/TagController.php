<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public $baseViewDirectory = 'tags.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tags = Tag::get();
        return view($this->baseViewDirectory . 'index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->baseViewDirectory . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TagRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->only(['name']));
        return redirect('/tags')->with('status', 'Tag added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view($this->baseViewDirectory . 'edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TagRequest $request
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $tag->update($request->only(['name']));
        return redirect('/tags')->with('status', 'Tag updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect('/tags')->with('status', 'Tag deleted successfully!');
    }
}
