<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('color')->nullable();
            $table->text('description')->nullable();
        });

        // Standart Typen für Ausgaben der Tabelle zuweisen
        $defaultTypes = [
            [
                'title' => 'Gas Station',
                'color'  => 'hsl(240, 30%, 35%)'
            ],
            [
                'title' => 'Ticket',
                'color' => 'hsla(355, 80%, 58%, 1)'
            ],
            [
                'title' => 'Service',
                'color' => 'hsl(40, 80%, 70%)'
            ],
            [
                'title' => 'Other',
                'color' => 'lightgrey'
            ]
        ];

        DB::table('expense_types')->insert($defaultTypes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_types');
    }
}
