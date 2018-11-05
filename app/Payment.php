<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $table = 'pagos';
    protected $guarded = ['created_at', 'updated_at'];

    public function contract()
    {
        return $this->belongsTo('App\Contract', 'id_contrato');
    }

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
}
