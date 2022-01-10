<?php

use App\Models\Character\Inventory;
use App\Models\Items\Item;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Inventory::class)->unsigned();
            $table->foreignIdFor(Item::class)->unsigned();
            $table->smallInteger('quantity')->unsigned()->default(1);
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
        Schema::dropIfExists('inventories_items');
    }
}
