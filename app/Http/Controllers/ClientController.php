<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Client;

class ClientController extends ApiController
{
    public function __construct(Client $client)
    {
        $this->model = $client;
        $this->searchable = ["id"];
    }
}
