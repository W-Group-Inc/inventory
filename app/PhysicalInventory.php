<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhysicalInventory extends Model
{
    //

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
