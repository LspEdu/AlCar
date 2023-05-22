<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
    ];


    /**
     * Propiedad que hace que el coche sea visible para todos los usuarios o no
     *
     * @var boolean
     */
    protected bool $validado;

}
