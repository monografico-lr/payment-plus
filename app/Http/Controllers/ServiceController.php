<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Service;

class ServiceController extends ApiController
{
    public function __construct(Service $service)
    {
        $this->model = $service;
        $this->searchable = ["id", "nombre", "mensualidad", "tipo"];
    }
}
