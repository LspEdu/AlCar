<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Factura;
use DateTime;
use Illuminate\Http\Request;

class FacturaController extends Controller
{

    public function index(Request $request)
    {
        return view('factura.index', [
            'facturas' => $request->user()->facturas,
        ]);
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        return "AQUÍ VA UN PDF";
    }

    public function alquilar(Request $request, $id)
    {
        $coche = Coche::find($id);
        $request->validate([
            'fechaInicio' => 'required | date',
            'fechaFin' => 'required | date',
        ]);

        $fechaInicio = new \DateTime($request->input('fechaInicio'));
        $fechaFin = new \DateTime($request->input('fechaFin'));

        $diff = $fechaFin->diff($fechaInicio);
        $factura = new Factura();


         $factura->FechaInicio = $fechaInicio;
        $factura->FechaFin = $fechaFin;
        $factura->importe = $coche->precio * $diff->days ;
        $factura->user()->associate($request->user());
        $factura->coche()->associate($coche);
        $factura->codigo = $factura->FechaFin->format('Ymd').$factura->FechaInicio->format('Ymd').$coche->matricula;
        $factura->lat = $coche->lat;
        $factura->lng = $coche->lng;
        $factura->save();

        return redirect()->route('dashboard');

    }
}
