<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeTaskMaterial extends Model
{
    protected $fillable = [
        'type_task_id',
        'material_id',
        'unit_id',
        'quantity_unit',
        'quantity'
    ];

    public function type_task()
    {
        return $this->belongsTo(TypeTask::class, 'type_task_id', 'id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
