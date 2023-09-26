<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }

    public function asset_type()
    {
        return $this->belongsTo(AssetType::class);
    }
}
