<?php

namespace App\Http\Controllers;
use App\Models\GrowWithTripTrack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class GrowWithTripTrackController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'password' => 'required|min:6',
        ]);

        $user = GrowWithTripTrack::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        // Notify Admin Email
        Mail::raw("New User Registered For Marketing:
        Name: $user->first_name
        Email: $user->email
        Mobile: $user->mobile", function ($message) use ($user) {
                    $message->to('triptrack88@gmail.com')
                            ->subject('New Grow With TripTrack Registration');
                });

        return back()->with('success', 'Your registration has been submitted successfully!');
    }
}

