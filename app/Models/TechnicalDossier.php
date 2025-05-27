<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicalDossier extends Model
{
    protected $fillable = [
        'project_id',
        'url_dossier',
        'type_dossier',
        'description',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
