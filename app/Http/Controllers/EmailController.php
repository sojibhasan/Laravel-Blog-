<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\BulkMail;
use App\Mail\QuickMail;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BulkMail as NotificationsBulkMail;

class EmailController extends Controller
{
    public function quickMail(Request $request) {
        
        $this->validate($request, array(
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'content' => 'required'
        ));

        Mail::to($request->email)->send(new QuickMail($request));
        Toastr::success('Mail send successful', '', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
