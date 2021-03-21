<?php

use App\Post;
use App\Comment;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logout', function(){
    Auth::logout();
    return redirect()->to('/login');
});

Route::get('/home', function() {
    return redirect()->to('/admin');
});

Auth::routes(['register' => false]);

// Backend Routes;
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('dashboard');
    Route::resource('/category', 'CategoryController');
    Route::resource('/profile', 'ProfileController');
    Route::get('change-password', 'PasswordController@index');
    Route::post('change-password', 'PasswordController@store')->name('change.password');
    Route::resource('/tag', 'TagController');
    Route::resource('/post', 'PostController');

    
    // Administrator;
    Route::middleware(['administrator'])->group(function () {
        Route::resource('/slider', 'SliderController');
        Route::resource('/social', 'SocialController');
        Route::resource('/setting', 'SettingController');
        Route::resource('/pages', 'PageController');
        
        Route::post('/quick', 'EmailController@quickMail')->name('quickMail');
        Route::post('/bulk', 'SendBulkMailController@sendBulkMail')->name('bulkMail');
        Route::get('/contact', 'ContactController@index')->name('contact.index');
        Route::get('/contact/{id}', 'ContactController@show')->name('contact.show');
        Route::get('/contact/reply/{id}', 'ContactController@reply')->name('contact.reply');
        Route::post('/contact/reply/send', 'ContactController@sendreply')->name('contact.reply.send');
        Route::post('/contact/delete/{id}', 'ContactController@destroy')->name('contact.delete');

        Route::get('notifications', function() {
            $notifications = DB::table('notifications')->orderBy('created_at', 'desc')->get();
            return  view('notification.index', compact('notifications'));
        })->name('notification');

        Route::get('/menu', function() {
            return view('menu.index');
        })->name('menu');

        Route::get('/marketing/single', 'MarketingController@single')->name('marketing.single');
        Route::get('/marketing/bulk', 'MarketingController@bulk')->name('marketing.bulk');
        Route::get('/marketing/subscribers', 'MarketingController@subscribers')->name('marketing.subscribers');
        Route::get('/subscriber/reply/{id}', 'SubscriberController@reply')->name('subscribers.reply');
        Route::post('/subscriber/destroy', 'SubscriberController@destroy')->name('subscribers.destroy');

        Route::get('/comment/{id}', 'CommentController@show')->name('comment.show');
        Route::post('/comment/{id}/update', 'CommentController@update')->name('comment.update');
        Route::get('/comment/{id}/reply', 'CommentController@reply')->name('comment.reply');
        Route::post('/comment/{id}/reply/send', 'CommentController@sendReply')->name('comment.reply.send');
        Route::post('/comment/delete', 'CommentController@destroy')->name('comment.destroy');

        

        Route::get('/comment/approved/{id}', 'CommentController@commentApproved')->name('comment.approved');
        Route::get('/comment/unapproved/{id}', 'CommentController@commentUnApproved')->name('comment.unapproved');
        Route::get('/documentation', function() {
            return view('doc.doc');
        })->name('doc');

        // Super admin;
        Route::middleware(['super_admin'])->group(function () {
            Route::resource('/user', 'UserController');
            Route::get('/gallery/blogs', 'GalleryController@blogs')->name('gallery.blogs');
            Route::get('/gallery/users', 'GalleryController@users')->name('gallery.users');
            Route::get('/gallery/sliders', 'GalleryController@sliders')->name('gallery.sliders');
        });
    });
        
});




// Front Routes;
Route::get('/post/category/{slug}', 'FrontController@postcategory')->name('post.category');
Route::get('/post/tag/{slug}', 'FrontController@posttag')->name('post.tag');
Route::get('post/{slug}', 'FrontController@singlepost')->name('single.post');
Route::post('/subscribe', 'SubscriberController@store')->name('subscribe');
Route::post('/contact', 'ContactController@store')->name('contact.store');
Route::post('/comment', 'CommentController@store')->name('comment');
Route::post('/search', 'FrontController@search')->name('search');
Route::get('/search/{result}', 'FrontController@result')->name('search.result');

Route::get('/', 'FrontController@index')->name('home');
Route::get('/contact', 'FrontController@contact')->name('contact');
Route::get('/about', 'FrontController@about')->name('about');
Route::get('/privacy', 'FrontController@privacy')->name('privacy');
Route::get('/terms', 'FrontController@terms')->name('terms');
Route::get('/posts', 'FrontController@allPost')->name('posts');

