<?php


namespace App\Models\World;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Biome extends Model
{

    /**
     * @return HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Models\World\Region');
    }

}
