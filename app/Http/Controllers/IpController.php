<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Ip;

class IpController extends ApiController
{
    public function __construct(Ip $ip)
    {
        $this->model = $ip;
        $this->searchable = ["id"];
    }
}
