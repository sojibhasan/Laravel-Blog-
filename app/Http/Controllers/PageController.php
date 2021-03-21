<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

        
        $this->validate($request, [
            'title' => 'required|max:255',
            'meta_tag' => 'required|max:255',
            'meta_des' => 'required|max:255',
            'another' => 'nullable|max:255',
        ]);

        $page->title = $request->title;
        $page->meta_tag = $request->meta_tag;
        $page->meta_des = $request->meta_des;
        if($request->another == null) {
            $page->another = '';
        }
        else {
            $page->another = $request->another;
        }
        $page->updated_by = auth()->user()->profile->name;

        $page->save();

        Toastr::success('Mail send successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
