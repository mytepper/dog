<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function getList()
    {
        $types = $this->orderBy('name', 'asc')
            ->get()
            ->toArray();
        
        return array_pluck($types, 'name', 'id');
    }
}
