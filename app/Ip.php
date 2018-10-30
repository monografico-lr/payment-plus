<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    //
    protected $table = 'ips';
    protected $guarded = ['created_at', 'updated_at'];

    public function section()
    {
        return $this->belongsTo('App\Section', 'seccion_id');
    }
}
