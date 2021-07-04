<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_equipment_tag extends Model
{
    //
    public function m_equipment() 
    {
        return $this->belongsTo('App\M_equipment');
    }
}
