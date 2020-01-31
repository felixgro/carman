<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
