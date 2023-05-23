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

    public function validar ($id)
    {
        $coche = Coche::find($id);
        $coche->validado = true;
        $coche->save();

        return redirect()->route('admin.index');
    }
}
