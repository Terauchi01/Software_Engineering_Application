<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminViewUserStatisticsInfoController extends Controller
{
    public function adminViewUserStatisticsInfo (){
        //viewの返すところは適当で良い
        return view('admin.AdminViewUserStatisticsInfo');
    }
    public function adminViewUserStatisticsInfoGraph (){
        //viewの返すところは適当で良い
        return view('admin.AdminViewUserStatisticsInfo');
    }
}
