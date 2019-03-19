<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    protected $table = 'contratos';
    protected $guarded = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_usuario');
    }

    public function service()
    {
        return $this->belongsTo('App\Service', 'id_servicio');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'id_cliente');
    }

    public function payments()
    {
        return $this->hasMany('App\Payments', 'id_contrato');
    }
}
