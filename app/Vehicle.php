<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function vehicle_type()
    {
        return $this->belongsTo('App\VehicleType');
    }

    public function vehicle_fuel()
    {
        return $this->belongsTo('App\VehicleFuel');
    }

    public function setting()
    {
        return $this->belongsTo('App\Setting');
    }

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

}
