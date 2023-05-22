<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CocheController extends Controller
{



    /**
     * Vista principal donde se muestran los coches
     *
     * @return void
     */
    public function index()
    {
        $coches = Coche::where('validado', true)->get();
        return view('coches.coches', [ // TODO THINK ABOUT NAMES
            'coches' => $coches
        ]);
    }



    /**
     * Creación de los coches.
     * Return a vista coche con mensaje a expectativas de validación de administrador
     *
     * @return void
     */
    public function create(Request $request)
    {

        if ($request->getMethod === 'POST') {
            // VALIDATE

            //SAVE

            //RETURN SUCCESFUL
        } else {


            return view('coches.create', [
                'combustibles' => [
                    'diesel',
                    'gasolina',
                    'electrico',
                    'hibrido'
                ],
            ]);
        }
    }


    /**
     * Vista del coche
     *
     * @param int $id
     * @return void
     */
    public function show($id)
    {
        $coche = Coche::find($id);

        return view('coches.index', [
            'coche' => $coche
        ]);
    }
}
