<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('vehicle_fuel_id');
            $table->unsignedBigInteger('setting_id')->nullable();

            $table->string('make');
            $table->string('model');
            $table->bigInteger('km');
            $table->string('plate');
        });

        $defaultVehicle = [
            'user_id' => 1,
            'vehicle_type_id' => 1,
            'vehicle_fuel_id' => 1,
            'setting_id' => 1,
            'make' => 'VW',
            'plate' => 'W 92493',
            'model' => 'Golf TDI',
            'km' => 15000
        ];

        DB::table('vehicles')->insert($defaultVehicle);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
