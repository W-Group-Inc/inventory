<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    public function dep()
    {
        return $this->belongsTo(Department::class,'department','id');
    }
}
