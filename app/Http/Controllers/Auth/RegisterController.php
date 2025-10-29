<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Show user registration form
    public function showUserRegisterForm()
    {
        return view('auth.register-user');
    }

    // Show seller registration form
    public function showSellerRegisterForm()
    {
        return view('auth.register-seller');
    }

    // Register as User
    public function registerUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',  // Changed from user_type to role
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Registration successful! Welcome to Jiji Beauty.');
    }

    // Register as Seller
    public function registerSeller(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'seller',  // Changed from user_type to role
            'business_name' => $validated['shop_name'],  // Map shop_name to business_name
            'phone' => $validated['phone'],
        ]);

        Auth::login($user);

        return redirect()->route('seller.dashboard')->with('success', 'Seller registration successful!');
    }
}