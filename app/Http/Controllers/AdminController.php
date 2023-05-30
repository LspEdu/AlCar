<?php

namespace App\Http\Controllers;

use App\Models\Coche;
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
        # code...
    }

    public function showUsuario()
    {
        # code...
    }

    public function validar ($id)
    {
        $coche = Coche::find($id);
        $coche->validado = !$coche->validado;
        $coche->save();

        return back();
    }
}
