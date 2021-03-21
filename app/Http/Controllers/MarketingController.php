<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    public function single() {
        return view('marketing.single');
    }

    public function bulk() {
        return view('marketing.bulk');
    }

    public function subscribers() {
        $subscribers = Subscriber::all();
        return view('marketing.subscribers', compact('subscribers'));
    }
}
