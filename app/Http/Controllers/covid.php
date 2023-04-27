<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class covid extends Controller
{
 
    public function index()
    {
        $response = Http::get('https://api.covid19api.com/summary');
        $data = $response->json();
        
        return view('covidshow', compact('data'));
    
}

}
