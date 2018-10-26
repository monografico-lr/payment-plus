<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Section;

class SectionController extends ApiController
{
    public function __construct(Section $section)
    {
        $this->model = $section;
        $this->searchable = ["id"];
    }
}
