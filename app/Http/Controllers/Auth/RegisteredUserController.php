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
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->email;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;

        $data = compact('email', 'password', 'password_confirmation');
        session($data);

        return view('auth.input-userdata', $data);
    }

    public function confirmUserdataPage(Request $request): View
    {
        $session = $request->session()->all();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:8'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $email = $session['email'];

        $name = $request->name;
        $postal_code = $request->postal_code;
        $address = $request->address;

        $data = compact(
            'email',
            'name',
            'postal_code',
            'address',
        );

        session($data);

        return view('auth.confirm-userdata', $data);
    }

    public function completePage(): View
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
        $data = $request->session()->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'email_verification_status' => '0'
        ]);

        $request->session()->flush();

        event(new Registered($user));

        return redirect()->route('register.complete');
    }
}
