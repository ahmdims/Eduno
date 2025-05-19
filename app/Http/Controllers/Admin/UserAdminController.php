<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => [
                'required',
                'string',
                'unique:users,username',
                'max:255',
                'regex:/^[a-z0-9_.]+$/',
            ],
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'phone_number' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'bio' => 'nullable|string|max:500',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',

            'username.required' => 'The username field is required.',
            'username.string' => 'The username must be a valid string.',
            'username.unique' => 'The username has already been taken.',
            'username.max' => 'The username may not be greater than 255 characters.',
            'username.regex' => 'The username may only contain lowercase letters, numbers, underscores, and dots.',

            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a valid string.',
            'password.min' => 'The password must be at least 6 characters.',

            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.max' => 'The phone number may not be greater than 15 characters.',

            'birth_date.date' => 'The birth date must be a valid date.',

            'gender.in' => 'The gender must be either Male, Female, or Other.',

            'bio.string' => 'The bio must be a valid string.',
            'bio.max' => 'The bio may not be greater than 500 characters.',
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'utype' => 'student',
        ]);

        return redirect()->back()->with('success', 'User created successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => [
                'nullable',
                'string',
                'unique:users,username,' . $id,
                'max:255',
                'regex:/^[a-zA-Z0-9_.]+$/',
            ],
            'name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string|in:Male,Female,Other',
            'bio' => 'nullable|string|max:500',
            'utype' => 'nullable|string',
        ], [
            'username.unique' => 'The username has already been taken.',
            'username.regex' => 'The username may only contain letters, numbers, underscores, and dots.',
            'username.max' => 'The username may not be greater than 255 characters.',

            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name may not be greater than 255 characters.',

            'phone_number.string' => 'The phone number must be a valid string.',
            'phone_number.max' => 'The phone number may not be greater than 15 characters.',

            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 255 characters.',

            'birth_date.date' => 'The birth date must be a valid date.',
            'gender.in' => 'The gender must be either Male, Female, or Other.',

            'bio.string' => 'The bio must be a valid string.',
            'bio.max' => 'The bio may not be greater than 500 characters.',
        ]);

        $user = User::findOrFail($id);

        $user->username = $request->input('username', $user->username);
        $user->name = $request->input('name', $user->name);
        $user->phone_number = $request->input('phone_number', $user->phone_number);
        $user->email = $request->input('email', $user->email);
        $user->birth_date = $request->input('birth_date', $user->birth_date);
        $user->gender = $request->input('gender', $user->gender);
        $user->bio = $request->input('bio', $user->bio);
        $user->utype = $request->input('utype', $user->utype);

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully!');
    }
}
