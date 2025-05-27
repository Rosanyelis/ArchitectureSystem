<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url_image',
        'customer_id',
        'budget_id',
        'user_id',
        'status',
        'start_date',
        'end_date',
        'address',
        'location',
        'province',                                                       
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getUrlImageAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class, 'project_id', 'id');
    }

    public function inventory()
    {
        return $this->hasMany(ProjectInventory::class, 'project_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(ProjectPermission::class, 'project_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class, 'project_id', 'id');
    }

    public function technical_reports()
    {
        return $this->hasMany(TechnicalDossier::class, 'project_id', 'id');
    }

    public function technical_reports_files()
    {
        return $this->hasMany(TechnicalReportFile::class, 'project_id', 'id');
    }

}
