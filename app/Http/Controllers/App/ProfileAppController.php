<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileAppController extends Controller
{
    public function index(Request $request, $username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        return view('profile.index', [
            'user' => $user,
        ]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255',
            'phone_number' => 'nullable|numeric',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string',
            'bio' => 'nullable|string',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->bio = $request->bio;

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('profile', 'public');
            $user->profile = 'profile/' . basename($path);
        }

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('banner', 'public');
            $user->banner = 'banner/' . basename($path);
        }

        $user->save();

        return Redirect::route('profile.edit', [Auth::user()->id])->with('status', 'Profile updated successfully!');
    }
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
