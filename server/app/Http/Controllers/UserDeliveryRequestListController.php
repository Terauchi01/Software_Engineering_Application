<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDeliveryRequestListController extends Controller
{
    public function userRequestDeliverlyList (){
        //viewの返すところは適当で良い
        return view('user.test');
    }
}
