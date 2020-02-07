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
            $table->boolean('world')->nullable(true);
            $table->boolean('region')->nullable(true);
            $table->boolean('city')->nullable(true);
            $table->boolean('male')->nullable(true);
            $table->boolean('female')->nullable(true);
            $table->boolean('family')->nullable(true);
            $table->boolean('item')->nullable(true);
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
