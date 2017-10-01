<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
