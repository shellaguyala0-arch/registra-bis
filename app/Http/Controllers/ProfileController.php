<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Show profile page.
     */
    public function edit()
    {
        $user = Auth::user();

        return view('profile.edit', compact('user'));
    }


    /**
     * Update profile details and profile photo.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'gender' => [
                'nullable',
                'string',
                Rule::in(['Male', 'Female', 'Other']),
            ],

            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp,gif',
                'max:2048',
            ],

            'remove_profile_photo' => [
                'nullable',
                'boolean',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE BASIC ACCOUNT INFORMATION
        |--------------------------------------------------------------------------
        */

        $user->name = $validated['name'];

        $user->username = $validated['username'];

        $user->email = $validated['email'];

        $user->gender = $validated['gender'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | REMOVE CURRENT PROFILE PHOTO
        |--------------------------------------------------------------------------
        */

        if (
            $request->boolean('remove_profile_photo')
            && $user->profile_photo
        ) {

            if (
                Storage::disk('public')
                    ->exists($user->profile_photo)
            ) {
                Storage::disk('public')
                    ->delete($user->profile_photo);
            }

            $user->profile_photo = null;
        }



        if ($request->hasFile('profile_photo')) {


            if (
                $user->profile_photo
                && Storage::disk('public')
                    ->exists($user->profile_photo)
            ) {

                Storage::disk('public')
                    ->delete($user->profile_photo);
            }


            $path = $request
                ->file('profile_photo')
                ->store('profile-photos', 'public');


            $user->profile_photo = $path;
        }



        $user->save();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Your profile has been updated successfully.'
            );
    }


    /**
     * Change password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);


        $user = Auth::user();


        $user->password = Hash::make(
            $request->password
        );

        $user->save();


        return redirect()
            ->route('profile.edit')
            ->with(
                'success',
                'Your password has been changed successfully.'
            );
    }
}