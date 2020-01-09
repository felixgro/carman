<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleFuel extends Model
{
    public function vehicles()
    {
        return $this->hasMany('App\Vehicle');
    }
}
