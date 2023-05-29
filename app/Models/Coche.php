<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class Coche extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'marca',
        'modelo',
        'tipo',
        'precio',
        'matricula',
        'combustible',
        'cambio',
        'ano',
        'motor',
        'km',
        'cilindrada',
        'color',
        'plazas',
        'lat',
        'lng',
        'foto',
        'dias'
    ];




    /**
     * Propiedad que hace que el coche sea visible para todos los usuarios o no
     *
     * @var boolean
     */
    protected bool $validado;



    /**
     * Tipos de coches
     */
    const TIPOS = [
        'utilitario',
        'deportivo',
        'superdeportivo',
        'biplaza',
        'offroad',
    ];

    /**
     * Tipos de combustible
     */
    const COMBUSTIBLES = [
        'diesel',
        'gasolina',
        'electrico',
        'hibrido',
    ];

    /**
     * Tipos de cambio
     */
    const CAMBIO = [
        'manual',
        'automatico',
    ];

    /**
     * Get the user that owns the Coche
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    public function setFoto(?string $foto)
    {
        $foto = str_replace('public', 'storage', $foto);
        $this->foto = $foto;
        $this->save();
    }



    public function setValidadoFalse()
    {
        $this->validado = false;
        $this->save();
    }
}
