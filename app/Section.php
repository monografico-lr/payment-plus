<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $table = 'secciones';
    protected $guarded = ['created_at', 'updated_at'];
}
