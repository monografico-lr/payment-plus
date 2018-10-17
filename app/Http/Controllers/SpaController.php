<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class SpaController extends Controller
{
    public function index(Request $request )
    {
        $user = $request->user();
        $company = Company::get();
        return view('home', [
            'user' => $user,
            'company' => $company
        ]);
    }
}
