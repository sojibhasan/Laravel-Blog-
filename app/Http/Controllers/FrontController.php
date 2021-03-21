<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Slider;
use App\Social;
use App\Comment;
use App\Setting;
use App\Category;
use App\Page;
use Illuminate\Http\Request;
use Harimayco\Menu\Models\Menus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Harimayco\Menu\Models\MenuItems;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class FrontController extends Controller
{
    // Index page;
    public function index()
    {
        $sliders = Slider::where('status', 1)->get();
        $categories = Category::with('posts')->get();
        $posts = Post::with('category', 'tag', 'user', 'comment')
            ->where('status', 1)
            ->orderBy('created_at', 'DESC')
            ->paginate(8);
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();
        $setting = Setting::all()->first();
        $popular_posts = Post::orderBy('visitor', 'desc')
            ->take(10)
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $most_visit = Post::orderBy('visitor', 'desc')->first();

        $visitor_ip = request()->ip();
        $visitor_find = DB::table('visitors')
            ->where('ip', $visitor_ip)
            ->first();

        if ($visitor_find == '') {
            DB::table('visitors')->insert([
                'ip' => $visitor_ip,
                'count' => 1,
            ]);
        } else {
            DB::table('visitors')
                ->where('ip', $visitor_ip)
                ->increment('count');
        }

        $socials = Social::all();

        $page_info = Page::where('label', 'home')->first();

        return view('front.index', compact('page_info', 'sliders', 'posts', 'categories', 'main_menu', 'setting', 'popular_posts', 'most_visit', 'socials'));
    }


    // About page;
    public function about()
    {
        $setting = Setting::all()->first();
        $socials = Social::all();
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();

        
        $page_info = Page::where('label', 'about')->first();
        return view('front.about', compact('page_info', 'setting', 'socials', 'main_menu'));
    }

        // Posts page;
        public function allPost()
        {
            $categories = Category::with('posts')->get();
            $posts = Post::with('category', 'tag', 'user', 'comment')
                ->where('status', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(8);
            $main_menu_id = Menus::where('name', 'main-menu')
                ->with('items')
                ->first();
            if (isset($main_menu_id)) {
                $main_menu_id = $main_menu_id->id;
            }
            $main_menu = MenuItems::where('menu', $main_menu_id)
                ->orderBy('sort')
                ->get();
            $setting = Setting::all()->first();
            $popular_posts = Post::orderBy('visitor', 'desc')
                ->take(10)
                ->with('category')
                ->inRandomOrder()
                ->limit(4)
                ->get();
            $most_visit = Post::orderBy('visitor', 'desc')->first();
    
            $socials = Social::all();
    
            $page_info = Page::where('label', 'posts')->first();
            return view('front.allpost', compact('page_info', 'posts', 'categories', 'main_menu', 'setting', 'popular_posts', 'most_visit', 'socials'));
        }

    // Return a single post;
    public function singlepost($slug)
    {
        $post = POST::with('category', 'tag', 'user')
            ->where('slug', $slug)
            ->firstOrFail();
        // $posts = Post::where('category_id', $post->category_id)->inRandomOrder()->limit(3)->get();
        $posts = Post::where('category_id', $post->category_id)
            ->where('slug', '!=', $slug)
            ->inRandomOrder()
            ->limit(3)
            ->with('comment')
            ->get();
        $prev = Post::where('id', '<', $post->id)
            ->orderBy('id', 'desc')
            ->first();
        // $prev = Post::where('id', '<', $post->id)->get()->sortByDesc('id')->first();
        $next = Post::where('id', '>', $post->id)
            ->orderBy('id')
            ->first();
        $categories = Category::all();
        if (count($post->tag) >= 10) {
            $tags = $post->tag->random(10);
        } else {
            $tags = $post->tag;
        }
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();
        $setting = Setting::all()->first();
        $post_visitor = Post::where('slug', $post->slug)->first()->visitor;
        DB::table('posts')
            ->where('slug', $post->slug)
            ->update(['visitor' => $post_visitor + 1]);
        $popular_posts = Post::orderBy('visitor', 'desc')
            ->take(10)
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $most_visit = Post::orderBy('visitor', 'desc')->first();
        $post_id = Post::where('slug', $slug)->first()->id;
        $comments = Comment::where('p_id', 0)
            ->where('post_id', $post_id)
            ->where('status', 1)
            ->get();
        $comment_count = count(
            Comment::where('post_id', $post_id)
                ->where('status', 1)
                ->get()
        );
        $socials = Social::all();

        return view('front.view', compact('post', 'posts', 'categories', 'prev', 'next', 'tags', 'setting', 'main_menu', 'popular_posts', 'most_visit', 'comments', 'comment_count', 'socials'));
    }

    // All Post by category;
    public function postcategory($slug)
    {
        $category_id = Category::where('slug', $slug)->firstOrFail()->id;
        $posts = Post::where('category_id', $category_id)
            ->with('comment')
            ->paginate(4);
        $categories = Category::all();
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();
        $setting = Setting::all()->first();
        $popular_posts = Post::orderBy('visitor', 'desc')
            ->take(10)
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $most_visit = Post::orderBy('visitor', 'desc')->first();
        $socials = Social::all();

        $page_info = Page::where('label', 'category')->first();
        return view('front.post', compact('page_info', 'posts', 'categories', 'main_menu', 'setting', 'popular_posts', 'most_visit', 'socials'));
    }

    // All post by tag;
    public function posttag($slug)
    {
        $tag_id = Tag::where('slug', $slug)->firstOrFail()->id;
        // $posts = Tag::with('posts')->where('id', $tag_id)->first()->posts->reverse();

        // Pagination creation by function below when need to create from array;
        $data = Tag::with('posts')
            ->where('id', $tag_id)
            ->first()->posts;
        $posts = $this->paginate($data);

        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();
        $setting = Setting::all()->first();
        $categories = Category::all();
        $popular_posts = Post::orderBy('visitor', 'desc')
            ->take(10)
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();
        $most_visit = Post::orderBy('visitor', 'desc')->first();
        $socials = Social::all();
        $page_info = Page::where('label', 'tag')->first();
        return view('front.post', compact('page_info', 'posts', 'categories', 'setting', 'main_menu', 'popular_posts', 'most_visit', 'socials'));
    }

    // Contact page;
    public function contact()
    {
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();
        $setting = Setting::all()->first();
        $socials = Social::all();
        $page_info = Page::where('label', 'contact')->first();
        return view('front.contact', compact('page_info', 'main_menu', 'setting', 'socials'));
    }

    // Search content get;
    public function search(Request $request)
    {
        return redirect()->route('search.result', $request->search);
    }

    // Search result page;
    public function result($result)
    {
        $most_visit = Post::orderBy('visitor', 'desc')->first();

        $setting = Setting::all()->first();
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();

        $categories = Category::all();
        $popular_posts = Post::orderBy('visitor', 'desc')
            ->take(10)
            ->with('category')
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $posts = Post::query()
            ->where('title', 'LIKE', "%{$result}%")
            ->paginate(8);

        $search_content = $result;
        $socials = Social::all();
        $page_info = Page::where('label', 'search')->first();
        return view('front.search', compact('page_info', 'setting', 'main_menu', 'categories', 'popular_posts', 'most_visit', 'posts', 'search_content', 'socials'));
    }

    // Privacy and policy;
    public function privacy()
    {
        $setting = Setting::all()->first();
        $socials = Social::all();
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();

        $page_info = Page::where('label', 'privacy')->first();
        return view('front.privacy', compact('page_info', 'setting', 'socials', 'main_menu'));
    }


    // Terms and conditions;
    public function terms()
    {
        $setting = Setting::all()->first();
        $socials = Social::all();
        $main_menu_id = Menus::where('name', 'main-menu')
            ->with('items')
            ->first();
        if (isset($main_menu_id)) {
            $main_menu_id = $main_menu_id->id;
        }
        $main_menu = MenuItems::where('menu', $main_menu_id)
            ->orderBy('sort')
            ->get();

        $page_info = Page::where('label', 'privacy')->first();
        return view('front.terms', compact('page_info', 'setting', 'socials', 'main_menu'));
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 4, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
