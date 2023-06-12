<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FacturaController extends Controller
{

    public function index(Request $request)
    {
        $facturas = $request->user()->facturas()->whereNotNull('user_id')->get();

        return view('factura.index', [
            'facturas' => $facturas,
            'hasFactura' => false,
        ]);
    }

    public function show($id)
    {
        $factura = Factura::find($id);
        if(!$factura->user) abort(403);
        $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=" . $factura->lat . "," . $factura->lng . "&key=" . env('GOOGLE_MAP_KEY'));
        $sitio = json_decode($json);



        $data = [
            'factura' => $factura,
            'titulo' => 'Factura_' . $factura->codigo,
            'hoy' => new \DateTime(),
            'dias' => 2,
            'sitio' => $sitio,
        ];

        $pdf = Pdf::loadView('factura.pdf', $data);
        return $pdf->stream();
    }


    public function destroy($codigo, Request $request)
    {
        $factura = Factura::where('codigo', $codigo)->get()[0];
        if($factura->coche->user_id == $request->user()->id){
            try{
                $factura->delete();
                return redirect()->back()->with('success', 'Días cancelados correctamente');
            }catch(\Exception $e){
                throw $e->getMessage();
            }
        }else{
            return redirect()->back();
        };
    }

    public function refund($codigo, Request $request)
    {
        $factura = Factura::where('codigo', $codigo)->get()[0];
        if($factura->user->id == $request->user()->id){
            try{
                $request->user()->refund($factura->token);
                $factura->delete();
                return redirect()->back()->with('success', 'Reembolso completado');
            }catch (\Exception $e){
                throw $e;
            }

        }else {
            return redirect()->back();
        }
    }



    public function reservar($id, Request $request)
    {
        $coche = Coche::find($id);
        if ($coche->user->id == $request->user()->id) {
            $request->validate([
                'fechaInicio' => 'required | date',
                'fechaFin' => 'required | date',
            ]);
            $alquilado = false;
            $facturas = $coche->facturas;
            $fechaInicio = new \DateTime($request->input('fechaInicio'));
            $fechaFin = new \DateTime($request->input('fechaFin'));
            foreach ($facturas as $factura) {
                $fechInicioAlquilado = new \DateTime($factura->FechaInicio);
                $fechFinAlquilado = new \DateTime($factura->FechaFin);
                $inicio = (($fechInicioAlquilado->getTimestamp() - $fechaInicio->getTimestamp()) / (60 * 60 * 24)) * -1;
                $fin = (($fechFinAlquilado->getTimestamp() - $fechaFin->getTimestamp()) / (60 * 60 * 24)) * -1;
                if (($inicio >= 0 && $fin <= 0) || ($inicio <= 0 && $fin >= 0)) $alquilado = true;
            }
            if ($alquilado)  return redirect()->back()->withErrors(['fechaInicio' => 'Error, no puedes seleccionar fechas que ya estén usadas'])->withInput();
            else {
                $diff = $fechaFin->diff($fechaInicio);
                $factura = new Factura();
                $factura->FechaInicio = $fechaInicio;
                $factura->FechaFin = $fechaFin;
                $factura->importe = 0;
                $factura->coche()->associate($coche);
                $factura->dias = $diff->days;
                $factura->codigo = $factura->FechaFin->format('Ymd') . $factura->FechaInicio->format('Ymd') . $coche->matricula;
                $factura->lat = $coche->lat;
                $factura->lng = $coche->lng;
                $factura->save();
                return redirect()->route('dashboard')->with('FacturaCreada', 'Perfecto. Has reservado correctamente tu coche');
            }
        } else {
            return '304';
        };
    }




    public function alquilar(Request $request, $id)
    {
        $coche = Coche::find($id);
        $request->validate([
            'fechaInicio' => 'required | date',
            'fechaFin' => 'required | date',
        ]);
        $alquilado = false;
        $facturas = $coche->facturas;

        $fechaInicio = new \DateTime($request->input('fechaInicio'));
        $fechaFin = new \DateTime($request->input('fechaFin'));
        foreach ($facturas as $factura) {
            $fechInicioAlquilado = new \DateTime($factura->FechaInicio);
            $fechFinAlquilado = new \DateTime($factura->FechaFin);
            $inicio = (($fechInicioAlquilado->getTimestamp() - $fechaInicio->getTimestamp()) / (60 * 60 * 24)) * -1;
            $fin = (($fechFinAlquilado->getTimestamp() - $fechaFin->getTimestamp()) / (60 * 60 * 24)) * -1;
            if (($inicio >= 0 && $fin <= 0) || ($inicio <= 0 && $fin >= 0)) $alquilado = true;
        }
        if ($alquilado)  return redirect()->back()->withErrors(['fechaInicio' => 'Error, selecciona un período de fechas válidos'])->withInput();

        $diff = $fechaFin->diff($fechaInicio);
        $factura = new Factura();

            if (!$request->user()->paymentMethods()) return redirect()->route('metodos');
            foreach ($request->user()->paymentMethods() as $metodo) {
                if ($metodo->card->last4 == $request->input('pago')) $method = $metodo;
            }
            if(!isset($method)){
                $method = $request->user()->DefaultPaymentMethod();
                $importe = ($diff->days * $coche->precio * 100)*0.3;
            }else $importe = $diff->days * $coche->precio * 100;
            if(is_null($method))return redirect()->route('metodos');
            $stripeCharge = $request->user()->charge(
                $importe,
                $method->id, [
                    'description' => $fechaFin->format('Ymd') . $fechaInicio->format('Ymd') . $coche->matricula,
                ]
            );
            $factura->metodoPago = $request->input('pago');
            $factura->token = $stripeCharge->id;



        $factura->FechaInicio = $fechaInicio;
        $factura->FechaFin = $fechaFin;
        $factura->importe = $coche->precio * $diff->days;
        $factura->user()->associate($request->user());
        $factura->coche()->associate($coche);
        $factura->dias = $diff->days;
        $factura->codigo = $factura->FechaFin->format('Ymd') . $factura->FechaInicio->format('Ymd') . $coche->matricula;
        $factura->lat = $coche->lat;
        $factura->lng = $coche->lng;
        $factura->save();

        return redirect()->route('dashboard')->with('success', 'Perfecto. Has reservado correctamente tu coche');
    }
}
