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

}
