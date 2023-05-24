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

        $factura = new Factura();

        $hoy  = new DateTime('now');
        $mañana = new DateTime('tomorrow');

        //TODO:: Rellenar a través del formulario del request
        $factura->FechaInicio = $hoy;
        $factura->FechaFin = $mañana;
        $factura->importe = $coche->precio*2;
        $factura->user()->associate($request->user());
        $factura->coche()->associate($coche);
        $factura->codigo = $factura->FechaFin->format('Ymd').$factura->user->id.$factura->FechaInicio->format('Ymd').$coche->matricula;
        $factura->lat = $coche->lat;
        $factura->lng = $coche->lng;
        $factura->save();

        return redirect()->route('dashboard');

    }
}
