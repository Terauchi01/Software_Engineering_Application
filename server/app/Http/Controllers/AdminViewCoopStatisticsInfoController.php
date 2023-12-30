<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminViewCoopStatisticsInfoController extends Controller
{
    public function adminViewCoopStatisticsInfo (){
        
        return view('admin.adminViewCoopStatisticsInfo');
    }
    public function adminViewCoopStatisticsInfoGraph (){
        // $id = 1;
        // $label = "日本の人口推移";
        // $labels = ['2015年', '2016年', '2017年', '2018年', '2019年', '2020年'];
        // $data = [127094745, 127041812, 126918546, 126748506, 126555078, 126146099];

        // return view('admin.adminViewCoopStatisticsInfo', compact('label', 'labels', 'data'));
        $labels = ['January', 'February', 'March', 'April', 'May'];
        $data = [10, 20, 30, 40, 50];

        return view('admin.adminViewCoopStatisticsInfoGraph', compact('labels', 'data'));
    }
}