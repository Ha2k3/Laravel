<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class studentcontroller extends Controller
{
    public function getStudent(){
        $name = 'Thúy Hà';
        $age = 20;
        $class = '24B';
        $arr = ['name' => $name ,'age'=>$age,'class'=>$class];
        return view('student')->with('hocsinh',$arr);
    }
}
