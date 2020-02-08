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
            [
                'title' => 'Mercedes',
                'icon' => 'vehicleIcons/mercedes'
            ],
            [
                'title' => 'BMW',
                'icon' => 'vehicleIcons/bmw'
            ],
            [
                'title' => 'Volkswagen',
                'icon' => 'vehicleIcons/vw'
            ],
            [
                'title' => 'Ford',
                'icon' => 'vehicleIcons/ford'
            ],
            [
                'title' => 'Audi',
                'icon' => 'vehicleIcons/audi'
            ],
            [
                'title' => 'Toyota',
                'icon' => 'vehicleIcons/toyota'
            ],
            [
                'title' => 'Tesla',
                'icon' => 'vehicleIcons/tesla'
            ],
            [
                'title' => 'Chevrolet',
                'icon' => 'vehicleIcons/chevrolet'
            ],
            [
                'title' => 'Hyndai',
                'icon' => 'vehicleIcons/hyndai'
            ],
            [
                'title' => 'Honda',
                'icon' => 'vehicleIcons/honda'
            ],
            [
                'title' => 'Kia',
                'icon' => 'vehicleIcons/kia'
            ],
            [
                'title' => 'Mitsubishi',
                'icon' => 'vehicleIcons/mitsubishi'
            ],
            [
                'title' => 'Nissan',
                'icon' => 'vehicleIcons/nissan'
            ],
            [
                'title' => 'Renault',
                'icon' => 'vehicleIcons/renault'
            ],
            [
                'title' => 'Mazda',
                'icon' => 'vehicleIcons/mazda'
            ],
            [
                'title' => 'Suzuki',
                'icon' => 'vehicleIcons/suzuki'
            ], 
            [
                'title' => 'Fiat',
                'icon' => 'vehicleIcons/fiat'
            ],
            [
                'title' => 'Volvo',
                'icon' => 'vehicleIcons/volvo'
            ],
            [
                'title' => 'Ferrari',
                'icon' => 'vehicleIcons/ferrari'
            ],
            [
                'title' => 'Lexus',
                'icon' => 'vehicleIcons/lexus'
            ],
            [
                'title' => 'Jeep',
                'icon' => 'vehicleIcons/jeep'
            ],
            [
                'title' => 'Citroen',
                'icon' => 'vehicleIcons/citroen'
            ],
            [
                'title' => 'Peugeot',
                'icon' => 'vehicleIcons/peugeot'
            ],
            [
                'title' => 'Subaru',
                'icon' => 'vehicleIcons/subaru'
            ],
            [
                'title' => 'Opel',
                'icon' => 'vehicleIcons/opel'
            ],
            [
                'title' => 'Yamaha',
                'icon' => 'vehicleIcons/yamaha'
            ],
            [
                'title' => 'Porsche',
                'icon' => 'vehicleIcons/porsche'
            ],
            [
                'title' => 'Mini',
                'icon' => 'vehicleIcons/mini'
            ],
            [
                'title' => 'Infiniti',
                'icon' => 'vehicleIcons/infiniti'
            ],
            [
                'title' => 'Ducati',
                'icon' => 'vehicleIcons/ducati'
            ],
            [
                'title' => 'Harley Davidson',
                'icon' => 'vehicleIcons/harley'
            ],
            [
                'title' => 'Acura',
                'icon' => 'vehicleIcons/acura'
            ],
            [
                'title' => 'Cadillac',
                'icon' => 'vehicleIcons/cadillac'
            ],
            [
                'title' => 'KTM',
                'icon' => 'vehicleIcons/ktm'
            ],
            [
                'title' => 'Buick',
                'icon' => 'vehicleIcons/buick'
            ],
            [
                'title' => 'Smart',
                'icon' => 'vehicleIcons/smart'
            ],
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
