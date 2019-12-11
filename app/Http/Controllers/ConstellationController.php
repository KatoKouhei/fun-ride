<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstellationController extends Controller
{
    public function index(){
        return view('constellation');
    }

    public function calculate($seiza){
        $constellations = [
            "ohitsuzi" => "おひつじ座",
            "ousi" => "おうし座",
            "hutago" => "ふたご座",
            "kani" => "かに座",
            "sisi" => "しし座",
            "otome" => "おとめ座",
            "tenbin" => "てんびん座",
            "sasori" => "さそり座",
            "ite" => "いて座",
            "yagi" => "やぎ座",
            "mizugame" => "みずがめ座",
            "uo" => "うお座",
        ];

        foreach($constellations as $key => $value){
            if($seiza == $key){
                return view('constellation', ['seiza' => $value]);
            }
        }

        // if($seiza == "ohitsuzi"){
        //     return view('constellation', ['ohitsuzi' => $ohitsuzi]);
        // }elseif($seiza == "ousi"){
        //     return view('constellation', ['ousi' => $ousi]);
        // }elseif($seiza == "hutago"){
        //     return view('constellation', ['hutago' => $hutago]);
        // }elseif($seiza == "kani"){
        //     return view('constellation', ['kani' => $kani]);
        // }elseif($seiza == "しし座"){
        //     return view('constellation', ['sisi' => $sisi]);
        // }elseif($seiza == "おとめ座"){
        //     return view('constellation', ['otome' => $otome]);
        // }elseif($seiza == "てんびん座"){
        //     return view('constellation', ['tenbin' => $tenbin]);
        // }elseif($seiza == "さそり座"){
        //     return view('constellation', ['sasori' => $sasori]);
        // }elseif($seiza == "いて座"){
        //     return view('constellation', ['ite' => $ite]);
        // }elseif($seiza == "やぎ座"){
        //     return view('constellation', ['yagi' => $yagi]);
        // }elseif($seiza == "みずがめ座"){
        //     return view('constellation', ['mizugame' => $mizugame]);
        // }elseif($seiza == "うお座"){
        //     return view('constellation', ['uo' => $uo]);
        // }
        
    }



}
