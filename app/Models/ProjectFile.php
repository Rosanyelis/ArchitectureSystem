<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    protected $fillable = [
        'project_id',
        'url_file',
        'type_file',
        'description',
    ];

    public function project()
}
