<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('currency_id');
            $table->boolean('select_main');
            $table->string('unit');
            $table->integer('home')->nullable();
        });

        $adminSetting = [
            'user_id' => 1,
            'vehicle_id' => 1,
            'select_main' => true,
            'unit' => 'km',
            'currency_id' => 1
        ];

        DB::table('settings')->insert($adminSetting);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
