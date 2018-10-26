<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'secciones';
    protected $guarded = ['created_at', 'updated_at'];

    public function ips()
    {
        return $this->hasMany('App\Ip');
    }
}
