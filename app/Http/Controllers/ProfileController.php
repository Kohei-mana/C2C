<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    //住所変更
    public function updateAddressPage()
    {
        return view('profile.update-address');
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return view('profile.edit');
    }

    //パスワード変更
    public function updatePasswordPage()
    {
        return view('profile.update-password');
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $request->user()->fill($request->validated());
        $request->user()->save();

        return view('profile.edit');
    }

    //メールアドレス変更
    public function updateEmailPage()
    {
        return view('profile.update-email');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
