<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'domicilio',
        'localidad',
        'provincia'
    ];

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'customer_id', 'id');
    }

}
