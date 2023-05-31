<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
class testslidecontroller extends Controller
{
    public function getIndex(){	
    	$slide =Slide::all();
    	//return view('page.trangchu',['slide'=>$slide]);
        $new_product = product::where('new',1)->get();	
        $sanpham_khuyenmai=product::where('promotion_price','<>',0)->get();
        // dd($new_product);	
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }	
}


