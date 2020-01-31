<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleManufacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_manufactures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('icon')->nullable();
        });

        $defaultData = [
            ['title' => 'Mercedes'],
            ['title' => 'BMW'],
            ['title' => 'Volkswagen'],
            ['title' => 'Ford'],
            ['title' => 'Audi'],
            ['title' => 'Toyota'],
            ['title' => 'Tesla'],
            ['title' => 'Chevrolet'],
            ['title' => 'Hyndai'],
            ['title' => 'Honda'],
            ['title' => 'Kia'],
            ['title' => 'Mitsubishi'],
            ['title' => 'Nissan'],
            ['title' => 'Renault'],
            ['title' => 'Mazda'],
            ['title' => 'Suzuki'],
            ['title' => 'Fiat'],
            ['title' => 'Volvo'],
            ['title' => 'Ferrari'],
            ['title' => 'Lexus'],
            ['title' => 'Honda'],
            ['title' => 'Jeep'],
            ['title' => 'Citroen'],
            ['title' => 'Peugeot'],
            ['title' => 'Subaru'],
            ['title' => 'Opel'],
            ['title' => 'Yamaha'],
            ['title' => 'Porsche'],
            ['title' => 'Mini'],
            ['title' => 'Infinity'],
            ['title' => 'Ducati'],
            ['title' => 'Harley Davidson'],
            ['title' => 'Acura'],
            ['title' => 'Cadillac'],
            ['title' => 'KTM'],
            ['title' => 'Buick'],
            ['title' => 'Smart'],
        ];

        DB::table('vehicle_manufactures')->insert($defaultData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_manufactures');
    }
}
