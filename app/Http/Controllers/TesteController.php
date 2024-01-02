<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function index()
    {
        require base_path('cron/rodaSH.php');
    }
}
