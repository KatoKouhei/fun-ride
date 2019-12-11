<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index(){
        return view('bmi');
    }

    public function calculate(Request $request){
        $weight = $request->weight;
        // dd($weight);
        $height = $request->height;
        $height_m = $height * 0.01;
        $bmi = $weight / ($height_m * $height_m);
        $bmi = round($bmi,1);
        // dd($bmi);
        return view('bmi',['bmi' => $bmi]);
    }
}


