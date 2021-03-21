<?php

namespace App\Http\Controllers;

use App\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::all();
        return view('social.index', compact('socials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('social.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:socials|max:255',
            'class' => 'required|unique:socials|max:255',
            'link' => 'url|required|unique:socials|max:255',
        ]);

        Social::create($request->all());

        return redirect()->route('social.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function show(Social $social)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function edit(Social $social)
    {
        $socials = Social::all();
        return view('social.edit', compact('socials', 'social'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        if ($social->name == $request->name) {
            if ($social->class == $request->class) {
                if ($social->link == $request->link) {
                    $request->validate([
                        'name' => 'required|max:255',
                        'class' => 'required|max:255',
                        'link' => 'url|required|max:255',
                    ]);
                } else {
                    $request->validate([
                        'name' => 'required|max:255',
                        'class' => 'required|max:255',
                        'link' => 'url|required|unique:socials|max:255',
                    ]);
                }
            } else {
                $request->validate([
                    'name' => 'required|max:255',
                    'class' => 'required|unique:socials|max:255',
                    'link' => 'url|required|max:255',
                ]);
            }
        } elseif ($social->class == $request->class) {
            if ($social->link == $request->link) {
                $request->validate([
                    'name' => 'required|unique:socials|max:255',
                    'class' => 'required|max:255',
                    'link' => 'url|required|max:255',
                ]);
            } else {
                $request->validate([
                    'name' => 'required|unique:socials|max:255',
                    'class' => 'required|max:255',
                    'link' => 'url|required|unique:socials|max:255',
                ]);
            }
        } elseif ($social->link == $request->link) {
            $request->validate([
                'name' => 'required|unique:socials|max:255',
                'class' => 'required|unique:socials|max:255',
                'link' => 'url|required|max:255',
            ]);
        } else {
            $request->validate([
                'name' => 'required|unique:socials|max:255',
                'class' => 'required|unique:socials|max:255',
                'link' => 'url|required|unique:socials|max:255',
            ]);
        }

        $social->name = $request->name;
        $social->class = $request->class;
        $social->link = $request->link;

        $social->save();

        return redirect()->route('social.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social $social)
    {
        $social->delete();
        return redirect()->route('social.index');
    }
}
