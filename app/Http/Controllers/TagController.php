<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::with('posts')->get();
        return view('tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('tag.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:555',
            ],
            [
                'name.required' => 'The tags filed is required',
            ]
        );

        $tags = explode(",", $request->name);

        foreach ($tags as $tag) {
            $tagDatabase = Tag::where('name', $tag)->first();
            if ($tagDatabase == '') {
                $tag_table = new Tag();
                $tag_table->name = strtolower($tag);
                $tag_table->slug = Str::of($tag)->slug('-');

                $tag_table->save();
            }
        }

        Toastr::success('Tags created successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        $tags = Tag::all();
        return view('tag.edit', compact('tags', 'tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags|max:255',
        ]);

        $tag->name = strtolower($request->name);
        $tag->slug = Str::of($request->name)->slug('-');

        $tag->save();
        Toastr::success('Tags updated successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tags = Tag::with('posts')
            ->where('id', $tag->id)
            ->first();

        if (count($tags->posts) > 0) {
            Toastr::warning('Sorry, this tag has post', '', ["positionClass" => "toast-top-right"]);
            return redirect()->route('tag.index');
        }

        $tag->delete();
        Toastr::success('Tag delete successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('tag.index');
    }
}
