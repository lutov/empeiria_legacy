<?php

use App\Models\Character;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersQualitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters_qualities', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Character::class)->unsigned();
            $table->smallInteger('appeal')->unsigned()->default(1);
            $table->smallInteger('vitality')->unsigned()->default(1);
            $table->smallInteger('intellect')->unsigned()->default(1);
            $table->smallInteger('sociality')->unsigned()->default(1);
            $table->smallInteger('mobility')->unsigned()->default(1);
            $table->smallInteger('willpower')->unsigned()->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters_qualities');
    }
}
