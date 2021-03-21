<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentNoti;
use App\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'comment' => 'required|max:555',
                'p_id' => 'required|integer',
                'post_id' => 'required|integer',
            ],
            [
                'name.required' => 'Please write your name',
                'email.required' => 'Please give me your email',
                'comment.required' => 'Please write something',
            ]
        );

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->p_id = $request->p_id;
        $comment->post_id = $request->post_id;

        if ($request->admin) {
            $comment->status = 1;
        } else {
            $comment->status = 0;
        }

        $comment->save();
        $user = User::findOrFail(1);
        $user->notify(new CommentNoti($request->name));
        Toastr::success('Comment submit successful please wait for admin approval', '', ["positionClass" => "toast-bottom-left"]);
        return redirect()->back();
    }


    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return view('contact.edit_comment', compact('comment'));
    }



    public function update(Request $request, Comment $comment)
    {
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);

        Comment::where('id', $request->id)->update([
            'comment' => $request->comment,
            'status' => 1,
        ]);

        Toastr::success('Comment updated successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('contact.index');
    }



    public function reply($id)
    {
        $comment = Comment::findOrFail($id);
        return view('contact.comment_reply', compact('comment'));
    }



    public function sendReply(Request $request, Comment $comment)
    {
        // return $request;

        $request->validate(
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'comment' => 'required|max:555',
            ],
            [
                'name.required' => 'Please write your name',
                'email.required' => 'Please give me your email',
                'comment.required' => 'Please write something',
            ]
        );

        $comment = new Comment();
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->p_id = $request->id;
        $comment->post_id = $request->post_id;

        $comment->status = 1;

        $comment->save();
        Toastr::success('Reply published successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('contact.index');
    }

    public function destroy(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        $comment->delete();
        return redirect()->route('contact.index');
    }

    public function commentApproved($id)
    {
        $comment = Comment::findOrFail($id);
        Comment::where('id', $id)->update([
            'status' => 1,
        ]);
        return redirect()->back();
    }

    public function commentUnApproved($id)
    {
        $comment = Comment::findOrFail($id);
        Comment::where('id', $id)->update([
            'status' => 0,
        ]);
        return redirect()->back();
    }
}
