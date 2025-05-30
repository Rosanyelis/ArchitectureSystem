<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPermission extends Model
{
    protected $fillable = [
        'project_id',
        'url_permission',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
