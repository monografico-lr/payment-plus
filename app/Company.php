<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'empresas';
    protected $guarded = ['created_at', 'updated_at'];

    public function get($id = 1) {
        return $this::find('id', $id);
    }

    public function update($id = 1, $data) {
        $company = $this::find($id);
        $company->update($data);
    } 
}
