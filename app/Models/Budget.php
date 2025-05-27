<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    protected $fillable = [
        'customer_id',
        'currency_id',
        'total',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(BudgetItem::class, 'budget_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(BudgetPayment::class, 'budget_id', 'id');
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('amount');
    }

}
