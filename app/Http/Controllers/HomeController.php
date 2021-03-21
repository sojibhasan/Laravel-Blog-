<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\User;
use App\Slider;
use App\Profile;
use App\Category;
use App\Social;
use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $post_count = count(Post::all('id'));
        $category_count = count(Category::all('id'));
        $tag_count = count(Tag::all('id'));
        $user_count = count(User::all('id'));
        $slider_count = count(Slider::all('id'));
        $profile_count = count(Profile::where('image', '!=' , null)->select('id')->get());
        $subscribers = Subscriber::orderBy('id', 'desc')->take(5)->get();
        $subscriber_count = count(Subscriber::all());
        $gallery_count = $profile_count + $slider_count + $post_count;
        $recent_post = Post::orderBy('id', 'desc')->take(5)->get(['title', 'visitor', 'id']);
        $top_visited_post = Post::orderBy('visitor', 'desc')->take(5)->get(['title', 'visitor', 'id']);
        $visitor_count = count(DB::table('visitors')->get());

        // return $profile_count + $slider_count + $post_count;
        return view('dashboard.index', compact('post_count', 'category_count', 'tag_count', 'user_count', 'gallery_count', 'subscriber_count', 'recent_post', 'top_visited_post', 'visitor_count', 'subscribers'));
    }
}
