<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table = 'clientes';
    protected $guarded = ['created_at', 'updated_at'];
}
