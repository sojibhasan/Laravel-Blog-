<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use App\Slider;
use App\User;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function users() {
        $users = Profile::paginate(8);
        return view('gallery.users', compact('users'));
    }

    public function sliders() {
        $sliders = Slider::paginate(8);
        return view('gallery.sliders', compact('sliders'));
    }

    public function blogs() {
        $blogs = Post::paginate(8);
        return view('gallery.blogs', compact('blogs'));
    }

}
