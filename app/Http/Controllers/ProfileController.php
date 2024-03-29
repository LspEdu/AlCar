<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
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



    public function show($id, Request $request)
    {
        $user = User::find($id);
        $facturado = false;
        if ($user->activo) {
            if ($request->user()->facturas) {
                foreach ($request->user()->facturas as $factura) {
                    if ($factura->user->id == $user->id || $factura->coche->user->id == $user->id) $facturado = true;
                }
            }
            return view('profile.perfil', [
                'user' => $user,
                'facturado' => $facturado,
            ]);
        } else {
            return redirect()->back();
        }
    }

    /**
     *  Update Users Avatar
     *
     *  TOIMPROVE:: Un recolector de basura recogería las imgs que no se esten usando una vez al mes
     */
    public function avatar(Request $request)
    {


        $request->validate([
            'avatar' => 'required|image|max:2048'
        ]);


        $avatar = $request->file('avatar')->store('public/avatars');
        $request->user()->setAvatar($avatar);
        return Redirect::route('dashboard');
    }



    /**
     * Update the user's profile information.
     */
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
     * Disable the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();
        $user->setActivo(false);
        foreach ($user->coches as $coche) {
            $coche->activo = false;
            $coche->save();
        }
        $user->save();

        Auth::logout();


        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
