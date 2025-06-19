<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        do {
            $username = 'user' . str_pad(random_int(0, 999999999999), 12, '0', STR_PAD_LEFT);
        } while (User::where('username', $username)->exists());

        $request->merge(['username' => $username]);

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status' => ['required', 'string'],
            'reason' => ['required', 'string'],
            'toc' => ['accepted'],
        ]);

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'reason' => $request->reason,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));
        // Auth::login($user);

        if ($request->ajax()) {
            return response()->json(['redirect' => route('login')]);
        }

        return response()->json([
            'message' => 'Registration successful',
            'redirect' => route('login'),
        ]);
    }
}
