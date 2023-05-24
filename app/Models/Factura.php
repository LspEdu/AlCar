<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [
        'FechaInicio',
        'FechaFin',
        'importe',
        'metodoPago',
        'codigo', /* Se genera así FechaFin.FechaInicio.this->coche->matricula */
        'lat',
        'lng',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coche()
    {
        return $this->belongsTo(Coche::class);
    }
}
