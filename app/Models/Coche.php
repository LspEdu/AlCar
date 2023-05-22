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
        'cilindrada',
        'color',
        'plazas',
        'lat',
        'lng',
        'user_id'
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


    public function setValidadoFalse()
    {
        $this->validado = false;
        $this->save();
    }
}
