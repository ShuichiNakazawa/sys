<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_equipment extends Model
{
    public function m_dept()
    {
        //return $this->belongsTo('App\M_dept');
        return $this->belongsTo('App\M_dept');
    }

    //
    public function t_equipment_tags()
    {
        return $this->hasMany('App\T_equipment_tag');
    }
}
