<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDoc extends Controller
{
    //
    public function index()
    {
        return view('apidoc.doc');
    }
}
