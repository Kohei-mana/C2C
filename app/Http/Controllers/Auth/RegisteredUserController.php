<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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

    public function userdataPage(Request $request): View
    {
        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        return view('auth.input-userdata', compact('email', 'password', 'password_confirmation'));
    }

    public function confirmUserdataPage(Request $request): View
    {
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;
        $postal_code = $request->postal_code;
        $address = $request->address;
        $password_confirmation = $request->password_confirmation;

        // FIXME: 規約違反
        return view('auth.confirm-userdata', compact('email', 'password', 'name', 'postal_code', 'address', 'password_confirmation'));
    }

    public function page4(): View
    {
        return view('auth.complete');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:8'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'email_verification_status' => '0'
        ]);

        return redirect()->route('complete');
    }
}
