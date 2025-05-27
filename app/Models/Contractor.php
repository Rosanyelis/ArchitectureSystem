<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    /** @use HasFactory<\Database\Factories\ContractorFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'domicilio',
        'localidad',
        'provincia',
    ];

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->apellido;
    }   
}
