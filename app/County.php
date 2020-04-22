<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class County extends Model
{
    use SoftDeletes;


    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }
}
