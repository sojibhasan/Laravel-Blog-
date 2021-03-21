<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Notifications\ProfileNoti;
use Brian2694\Toastr\Facades\Toastr;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = Profile::with('user')
            ->where('user_id', auth()->user()->id)
            ->first();
        return view('profile.edit', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect()->route('profile.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return redirect()->route('profile.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return redirect()->route('profile.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $request->validate([
            'facebook' => 'url|nullable',
            'twitter' => 'url|nullable',
            'linkedin' => 'url|nullable',
            'name' => 'nullable|max:200',
            'occupation' => 'nullable',
            'about' => 'nullable',
            'image' => 'nullable',
        ]);

        $profile->name = $request->name;
        $profile->occupation = $request->occupation;
        $profile->about = $request->about;
        $profile->facebook = $request->facebook;
        $profile->twitter = $request->twitter;
        $profile->linkedin = $request->linkedin;
        $profile->image = $request->image;

        $profile->update();

        $user_role = auth()->user()->role;

        auth()
            ->user()
            ->notify(new ProfileNoti($profile));

        if ($user_role == 1) {
            Toastr::success('Successfully Updated', '', ["positionClass" => "toast-top-right"]);
            return redirect()->route('user.index');
        } else {
            Toastr::success('Successfully Updated', '', ["positionClass" => "toast-top-right"]);
            return redirect()->route('profile.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        return redirect()->route('profile.index');
    }
}
