<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SubscriptionController extends Controller
{
    /**
     * Handle subscription requests.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $subscriber = Subscriber::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_subscribed' => true
        ]);

        Mail::to($subscriber->email)->send(new WelcomeMail($subscriber));

        return response()->json(['message' => 'Subscription successful'], 200);
    }

    /**
     * Handle unsubscribe requests.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unsubscribe(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:subscribers,email',
        ]);

        $subscriber = Subscriber::where('email', $validated['email'])->firstOrFail();
        $subscriber->update(['is_subscribed' => false]);

        return response()->json(['message' => 'You have been unsubscribed'], 200);
    }
}
