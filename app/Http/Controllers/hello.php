<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class hello extends Controller
{
    public function xinchao(){
        $tieude = "Đây là trang tiêu đề";
        return view('test')->with('title',$tieude);
    }
}
