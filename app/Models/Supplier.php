<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    protected $fillable = [
        'razon_social',
        'cuit',
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'domicilio',
        'localidad',
        'provincia'
    ];

    
}
