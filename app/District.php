<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function getList($provinceId)
    {
        $districts = $this->orderBy('name_th', 'asc')
            ->where('province_id', $provinceId)
            ->get()
            ->toArray();
        
        return array_pluck($districts, 'name_th', 'id');
    }
}
