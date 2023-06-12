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

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ape1' => ['required', 'string', 'max:255' ],
            'ape2' => ['nullable','string', 'max:255'],
            'fechNac' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'dni' => ['required', 'string', 'min:9', 'max:9', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tlf' => ['required', 'integer'],
            'direccion' => ['nullable', 'string']
        ]);

        $user = User::create([
            'name' => $request->name,
            'ape1' => $request->ape1,
            'ape2' => $request->ape2,
            'fechNac' => $request->fechNac,
            'email' => $request->email,
            'dni' => $request->dni,
            'password' => Hash::make($request->password),
            'tlf' => $request->tlf,
            'direccion' => $request->direccion,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
