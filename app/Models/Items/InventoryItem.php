<?php


namespace App\Models\Items;


use Illuminate\Database\Eloquent\Relations\Pivot;

class InventoryItem extends Pivot
{
    protected $visible = [
        'quantity',
        'sort',
    ];
}
