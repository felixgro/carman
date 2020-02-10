<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('icon');
            $table->text('description')->nullable();
        });

        // Standart Typen für Fahrzeuge der Tabelle zuweisen
        $defaultTypes = [
            [
                'title' => 'Scooter',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Bike',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Quad',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Car',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Van',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Truck',
                'icon' => 'vehicleTypes/car'
            ],
            [
                'title' => 'Bus',
                'icon' => 'vehicleTypes/car'
            ],
        ];

        DB::table('vehicle_types')->insert($defaultTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_types');
    }
}
