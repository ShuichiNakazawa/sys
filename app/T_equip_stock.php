<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class T_equip_stock extends Model
{
    //
    public function m_equipment()
    {
        return $this->hasOne('App\M_equipment');
    }
}
