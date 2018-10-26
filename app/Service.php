<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Service extends Model
{
    //
    use Searchable;
    protected $table = 'servicios';
    protected $guarded = ['created_at', 'updated_at'];
}
