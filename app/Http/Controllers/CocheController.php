<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $coches = Coche::where('validado', true)->where('activo',true)->get();


        return view('coches.list', [ // TODO THINK ABOUT NAMES
            'coches' => $coches,
            'tipos' => Coche::TIPOS,
            'combustibles' => Coche::COMBUSTIBLES,
            'cambio' => Coche::CAMBIO,
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
            'matricula' => 'required |unique:coches,matricula| string | min:7 | max:15',
            'combustible' => 'nullable | in:' . implode(',', Coche::COMBUSTIBLES),
            'cambio' => 'required | in:' . implode(',', Coche::CAMBIO),
            'ano' => 'nullable | date | after_or_equal:today',
            'motor' => 'nullable | string | max:255',
            'cilindrada' => 'nullable | string | max:255',
            'color' => 'nullable | string | max:255',
            'plazas' => 'nullable | integer | max:14 | min:1',
            'km' => 'nullable | integer | min:1',
            'foto' => 'required | image | max:2028',
        ]);

        $coche = $request->user()->coches()->create($request->all());
        $coche->setFoto($request->file('foto')->store('public/coches/'.$coche->matricula));


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


        $coche = Coche::findOrFail($id);

        return view('coches.index', [
            'coche' => $coche,
        ]);

    }

    public function json($id)
    {

        $coche = Coche::findOrFail($id);
        return response()->json($coche);

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
        if($coche->user == Auth::user())
        return view('coches.edit', [
            'coche' => $coche,
            'combustibles' => Coche::COMBUSTIBLES,
            'tipos' => Coche::TIPOS,
            'cambio' => Coche::CAMBIO,
        ]);
        else return back();
    }

    public function activoCoche($id) {

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
            'foto' => 'nullable|image|max:4096',
        ]);

        $coche = Coche::find($id);

        $img = $coche->foto;

        $coche->update($request->all());
        $coche->setAttribute('validado', false);
        $request->file('foto')
        ? $coche->setFoto($request->file('foto')->store('public/coches/'.$coche->matricula))
        : $coche->foto = $img;
        $request->activo ? $coche->activo = true : $coche->activo = false;
        $request->input('lat') ? $coche->lat = $request->input('lat') : $coche->lat = $coche->lat;
        $request->input('lng') ? $coche->lng = $request->input('lng') : $coche->lng = $coche->lng;
        $coche->save();

        return redirect()->route('coche.show', [
            'id' => $coche->id,
        ]);
    }

    public function destroy($id)
    {
        $coche = Coche::findOrFail($id);
        $coche->activo = false;
        return redirect()->route('dashboard');
    }
}
