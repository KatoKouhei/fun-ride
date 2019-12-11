<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opinion;

class OpinionController extends Controller
{
    public function opinion(Request $request){
        $request->validate([
            'opinion' => ['required', 'string', 'max:255',],
        ]);
        $opinion = $request->opinion;
        Opinion::create([
            'opinion'=>$opinion,
        ]);
        return view('welcome');
    }
}