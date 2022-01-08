<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 256);
            $table->string('alt_name', 256);
            $table->boolean('first_name')->nullable();
            $table->boolean('nickname')->nullable();
            $table->boolean('last_name')->nullable();
            $table->boolean('none')->nullable();
            $table->boolean('male')->nullable();
            $table->boolean('female')->nullable();
            $table->boolean('world')->nullable();
            $table->boolean('region')->nullable();
            $table->boolean('city')->nullable();
            $table->boolean('faction')->nullable();
            $table->boolean('squad')->nullable();
            $table->boolean('item')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('names');
    }
}
