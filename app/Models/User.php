<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'ape1',
        'ape2',
        'fechNac',
        'direccion',
        'tlf',
        'email',
        'password',
        'avatar',
    ];

    private string $rol;


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function setAvatar(string $avatar)
    {
        $avatar = str_replace('public', 'storage', $avatar);
        $this->avatar = $avatar;
        $this->save();
    }


    /**
     * Get all of the coches for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coches(): HasMany
    {
        return $this->hasMany(Coche::class);
    }


    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }


    public function getRol()
    {
        return $this->rol;
    }
}
