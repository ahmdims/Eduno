<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->bio = $request->bio;

        if ($request->hasFile('profile')) {
            if ($user->profile) {
                Storage::disk('public')->delete($user->profile);
            }

            $image = $request->file('profile');
            $imageName = 'profile_' . time() . '.webp';
            $imagePath = 'profile/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->fit(300, 300)
                ->encode('webp', 90);

            Storage::disk('public')->put($imagePath, $img);
            $user->profile = $imagePath;
        }

        if ($request->hasFile('banner')) {
            if ($user->banner) {
                Storage::disk('public')->delete($user->banner);
            }

            $image = $request->file('banner');
            $imageName = 'banner_' . time() . '.webp';
            $imagePath = 'banner/' . $imageName;

            $img = Image::make($image->getRealPath())
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('webp', 90);

            Storage::disk('public')->put($imagePath, $img);
            $user->banner = $imagePath;
        }

        $user->save();

        return Redirect::route('profile.edit', [$user->id])->with('status', 'Profile updated successfully!');
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
