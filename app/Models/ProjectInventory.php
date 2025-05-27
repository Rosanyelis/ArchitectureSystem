<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectInventory extends Model
{
    protected $fillable = [
        'project_id',
        'material_id',
        'unit_id',
        'quantity',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
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
