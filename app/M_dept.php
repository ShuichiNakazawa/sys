<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_dept extends Model
{
    //
    public function M_equipments()
    {
        return $this->hasMany('App\M_equipment');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
