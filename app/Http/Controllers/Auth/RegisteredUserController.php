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

    // ここでページ２を追加
    public function page2(): View
    {
        return view('auth.userdata');
    }

    public function page3(): View
    {
        return view('auth.confirm-userdata');
    }

    public function show(Request $request, string $id): View
    {
        $value = $request->session()->all();

        // ...

        $user = $this->users->find($id);

        return view('auth.confirm-userdata', ['user' => $user]);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => 'manabe',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'postal_code' => '123-1234',
            'address' => '東京都',
            'email_verification_status' => '0'
        ]);
        

        return redirect(RouteServiceProvider::HOME);
    }
}