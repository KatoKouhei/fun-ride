<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarkdownController extends Controller
{
    // マークダウンに変換するメソッド
    public function convert(Request $request){
        $description = $request->description;
        $Parsedown = new \Parsedown();
        $description = $Parsedown->text($description);
        return response()->json(['description' => $description]);
    }
    public function markdown(){
        return view('markdown');
    }
}
