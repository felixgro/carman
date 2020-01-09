<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
    public function vehicles()
    {
        return $this->hasMany('App\Vehicles');
    }
}
