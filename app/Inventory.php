<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function employee_inventory()
    {
        return $this->hasMany(EmployeeInventories::class,'inventory_id','id');
    }


}
