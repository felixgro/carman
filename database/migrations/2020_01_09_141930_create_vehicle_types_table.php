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
            $table->text('description')->nullable();
        });

        // Standart Typen für Fahrzeuge der Tabelle zuweisen
        $defaultTypes = [
            ['title' => 'Car'],
            ['title' => 'Motorbike'],
            ['title' => 'Quad'],
            ['title' => 'Scooter']
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
