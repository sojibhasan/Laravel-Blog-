<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Contact;
use App\Mail\ReplyMail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all()->reverse();
        $comments = Comment::all()->reverse();
        return view('contact.index', compact('contacts', 'comments'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'content' => 'required',
            ],
            [
                'name.required' => 'Please write your name',
                'email.required' => 'Please give me your email',
                'subject.required' => 'Please write subject',
                'content.required' => 'Please write massage',
            ]
        );

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->content = $request->content;
        $contact->status = 0;
        $contact->save();
        return redirect()->back();
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        Contact::where('id', $id)->update(['status' => 1]);
        $info = Contact::where('id', $id)->first();
        return view('contact.show', compact('info'));
    }

    public function reply($id)
    {
        $contact = Contact::findOrFail($id);
        Contact::where('id', $id)->update(['status' => 1]);
        $info = Contact::where('id', $id)->first();
        return view('contact.massage_reply', compact('info'));
    }

    public function sendreply(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Mail::to($request->email)->send(new ReplyMail($request));
        Toastr::success('Reply send successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->route('contact.index');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->back();
    }
}
