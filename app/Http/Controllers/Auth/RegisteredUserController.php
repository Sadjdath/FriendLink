<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\PrivacySetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        PrivacySetting::create([
            'user_id' => $user->id,
            'profile_visibility' => 'shared_interests',
            'who_can_contact' => 'verified_only',
            'requires_manual_whatsapp_confirmation' => true,
        ]);

        Auth::login($user);

        return redirect()->route('onboarding.interests');
    }
}