<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminViewCoopInfoController extends Controller
{
    public function adminViewCoopInfo (){
        //viewの返すところは適当で良い
        return view('user.test');
    }
}