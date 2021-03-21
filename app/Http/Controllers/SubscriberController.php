<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    // Store from frontend page;
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:255',
        ]);

        $dataSub = Subscriber::where('email', $request->email)->first();
        if ($dataSub == '') {
            $subscriber = new Subscriber();
            $subscriber->email = $request->email;
            $subscriber->count = 1;
            $subscriber->save();
        } else {
            DB::table('subscribers')
                ->where('email', $request->email)
                ->increment('count');
        }

        Toastr::success('Thank you for subscribe. We will give you all update.', '', ["positionClass" => "toast-bottom-left"]);
        return redirect()->back();
    }



    public function reply ($id) {
        $subscriber_id = Subscriber::findOrFail($id);
        $subscriber_email = $subscriber_id->email;

        return view('marketing.single', compact('subscriber_email'));
    }

    public function destroy (Request $request) {
        $subscriber = Subscriber::findOrFail($request->id);
        $subscriber->delete();

        return redirect()->route('marketing.subscribers');
    }
}
