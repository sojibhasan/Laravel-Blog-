<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Jobs\SendBulkQueueEmail;
use Brian2694\Toastr\Facades\Toastr;

class SendBulkMailController extends Controller
{
    public function sendBulkMail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255',
            'subject' => 'required',
            'content' => 'required',
        ]);

        $valid_email = 0;
        $invalid_email = 0;

        foreach (Str::of($request->email)->explode(',') as $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $valid_email++;
            } else {
                $invalid_email++;
            }
        }

        $main_info = [
            'subject' => $request->subject,
            'content' => $request->content,
            'email' => $request->email,
        ];

        // send all mail in the queue.
        $job = (new SendBulkQueueEmail($main_info))->delay(now()->addSeconds(2));

        dispatch($job);

        Toastr::success($valid_email . ' Mail sending start', '', ["positionClass" => "toast-top-right"]);
        if ($invalid_email > 0) {
            Toastr::warning($invalid_email . ' Invalid email address', '', ["positionClass" => "toast-top-right"]);
        }
        return redirect()->back();
    }
}
