<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTask extends Model
{
    protected $fillable = [
        'project_id',
        'type_task_id',
        'quantity',
        'percentage_progress',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function type_task()
    {
        return $this->belongsTo(TypeTask::class, 'type_task_id', 'id');
    }
}
