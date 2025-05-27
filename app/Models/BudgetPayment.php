<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetPayment extends Model
{
    protected $fillable = [
        'budget_id',
        'customer_id',
        'payment_method_id',
        'dollar_rate_id',
        'currency_id',
        'concept',
        'amount',
        'amount_pesos',
        'payment_date'
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id', 'id');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function dollar_rate()
    {
        return $this->belongsTo(DollarRate::class, 'dollar_rate_id', 'id');
    }
}
