<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('short');
            $table->string('symbol');
        });

        $currencies = [
            [
                'title' => 'Euro',
                'short' => 'EUR',
                'symbol' => '€'
            ],
            [
                'title' => 'Dollar',
                'short' => 'USD',
                'symbol' => '$'
            ],
        ];

        DB::table('currencies')->insert($currencies);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
