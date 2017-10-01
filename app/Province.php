<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function getList()
    {
        $provinces = $this->orderBy('name_th', 'asc')
            ->get()
            ->toArray();
        
        return array_pluck($provinces, 'name_th', 'id');
    }
}
