<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Landing;
use Illuminate\Http\Request;

class LangingController extends Controller
{
    public function index($id)
    {
        $indication = Landing::all()->first();
        $user = User::find($id);
        $login = $user->login;
        return view('welcome.landingpage', compact('login','indication'));
    }
}
