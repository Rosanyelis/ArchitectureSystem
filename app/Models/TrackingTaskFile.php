<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingTaskFile extends Model
{
    protected $fillable = [
        'tracking_task_id',
        'url_file',
        'description',
    ];

    public function tracking_task()
    {
        return $this->belongsTo(TrackingTask::class, 'tracking_task_id', 'id');
    }

    public function getUrlFileAttribute($value)
    {
        return asset('storage/' . $value);
    }
}
