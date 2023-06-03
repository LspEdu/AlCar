<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $cochesInvalidados = Coche::where('validado', false)->get();

        return view('admin.index', [
            'cochesInvalidados' => $cochesInvalidados,
            'numCoches' => $cochesInvalidados->count(),
        ]);
    }

    public function coches() {

        $coches = Coche::all();
        return view('admin.coches-list', [
            'coches' => $coches
        ]);
    }

    public function showCoche($id)
    {
        $coche = Coche::find($id);

        return view('admin.coche', [
            'coche' => $coche,
        ]);
    }

    public function usuarios()
    {
        $usuarios = User::all();
        return view('admin.users-list', [
            'usuarios' => $usuarios,
        ]);
    }

    public function showUsuario($id)
    {
        $usuario = User::find($id);
        return view('admin.user', [
            'user' => $usuario,
        ]);
    }

    public function destroyUsuario($id)
    {
        $usuario = User::find($id);
        $usuario->setActivo(false);
        foreach ($usuario->coches as $coche) {
            $coche->activo = false;
            $coche->save();

        }
        $usuario->save();
        return redirect()->route('admin.usuarios')->with('status', 'Usuario borrado');

    }

    public function destroyCoche($id)
    {
        $coche = Coche::find($id);
        $coche->activo = false;
        return redirect()->route('admin.coches')->with('status', 'Coche Borrado');
    }

    public function validar ($id)
    {
        $coche = Coche::find($id);
        $coche->validado = !$coche->validado;
        $coche->save();

        return back();
    }
}
