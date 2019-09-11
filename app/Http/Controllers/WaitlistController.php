<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Mail\SubscriberJoined;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\WaitlistRequest;

class WaitlistController extends Controller
{
    public function index()
    {
        return view('waitlist');
    }

    public function subscribe(WaitlistRequest $request)
    {
        $subscriber = Subscriber::create([
            'email' => $request->email,
        ]);
          
        Mail::to($request->email)->send(
            new SubscriberJoined($subscriber)
        );
        
        return redirect()->route('waitlist.subscribed');
    }

    public function subscribed()
    {
        return view('subscribed');
    }
}
