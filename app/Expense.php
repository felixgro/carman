<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function expense_type()
    {
        return $this->belongsTo('App\ExpenseType');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function scopeThisMonth($query)
    {
        $now = \Carbon\Carbon::now();

        return $query->where('created_at', '>', $now->startOfMonth()->format('Y-m-d H:i:s'));
    }

    public function scopeThisYear($query)
    {
        $now = \Carbon\Carbon::now();

        return $query->where('created_at', '>', $now->startOfYear()->format('Y-m-d H:i:s'));
    }

}
