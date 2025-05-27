<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingTask extends Model
{
    protected $fillable = [
        'project_task_id',
        'user_id',
        'description',
        'percentage_progress',
    ];

    public function project_task()
    {
        return $this->belongsTo(ProjectTask::class, 'project_task_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tracking_task_files()
    {
        return $this->hasMany(TrackingTaskFile::class, 'tracking_task_id', 'id');
    }
}
