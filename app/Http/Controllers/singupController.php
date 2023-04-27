<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Symfony\Component\Console\Input\Input,Spatie\Backtrace\File;

use Request;
use App\Http\Requests\signupRequest;

class singupController extends Controller
{
    public function index(){
        return view('form');
    }
    public function displayInfor(signupRequest $Request){
        $user=[
            'name'=>$name = $Request -> input('name'),
            'age'=>$age= $Request->input('age'),
            'date'=>$date=$Request->input('date'),
            'phone'=>$phone =$Request->input('phone'),
            'web'=>$web= $Request->input('web'),
            'address'=>$address=$Request->input('address')
        ];
        return view('form')->with('user',$user);
    }
}
