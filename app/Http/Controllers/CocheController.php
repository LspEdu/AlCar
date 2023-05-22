<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

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


    public function create()
    {

        return view('coches.create', [
            'combustibles' => Coche::COMBUSTIBLES,
            'tipos' => Coche::TIPOS,
            'cambio' => Coche::CAMBIO,
        ]);
    }

    /**
     * Creación de los coches.
     * Return a vista coche con mensaje a expectativas de validación de administrador
     *
     * @return void
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required| string | max:255',
            'modelo' => 'required | string | max:255',
            'tipo' => 'required | in:' . implode(',', Coche::TIPOS),
            'precio' => 'required | integer | min:1',
            'matricula' => 'required | string | min:7',
            'combustible' => 'nullable | in:' . implode(',', Coche::COMBUSTIBLES),
            'cambio' => 'required | in:' . implode(',', Coche::CAMBIO),
            'ano' => 'nullable | date | after_or_equal:today',
            'motor' => 'nullable | string | max:255',
            'cilindrada' => 'nullable | string | max:255',
            'color' => 'nullable | string | max:255',
            'plazas' => 'nullable | integer | max:14 | min:1',
        ]);

        $coche = $request->user()->coches()->create($request->all());

        return redirect()->route('coche.show', [
            'id' => $coche->id,
        ]);
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
            'coche' => $coche,
        ]);
    }

    /**
     * Vista para editar el coche si eres dueño
     *
     * @param int $id
     * @return void
     */
    public function edit(Request $request, $id)
    {
        $coche = Coche::find($id);
        return view('coches.edit', [
            'coche' => $coche,
            'combustibles' => Coche::COMBUSTIBLES,
            'tipos' => Coche::TIPOS,
            'cambio' => Coche::CAMBIO,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'marca' => 'required| string | max:255',
            'modelo' => 'required | string | max:255',
            'tipo' => 'required | in:' . implode(',', Coche::TIPOS),
            'precio' => 'required | integer | min:1',
            'matricula' => 'required | string | min:7',
            'combustible' => 'nullable | in:' . implode(',', Coche::COMBUSTIBLES),
            'cambio' => 'required | in:' . implode(',', Coche::CAMBIO),
            'ano' => 'nullable | date | after_or_equal:today',
            'motor' => 'nullable | string | max:255',
            'cilindrada' => 'nullable | string | max:255',
            'color' => 'nullable | string | max:255',
            'plazas' => 'nullable | integer | max:14 | min:1',
        ]);

        $coche = Coche::find($id);

        $coche->fill($request->all());
        $coche->setAttribute('validado', false);
        $coche->save();

        return redirect()->route('coche.show', [
            'id' => $coche->id,
        ]);
    }

    public function destroy($id)
    {
        $coche = Coche::find($id);
        $coche->delete();
        return redirect()->route('dashboard');
    }
}