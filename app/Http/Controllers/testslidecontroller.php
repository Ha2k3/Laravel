<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Http\Controllers\Controller;
use App\Models\comment;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\typeProduct;

class testslidecontroller extends Controller
{
    public function getIndex(){	
    	$slide =Slide::all();
    	//return view('page.trangchu',['slide'=>$slide]);
        $new_product = product::where('new',1)->get();	
        $sanpham_khuyenmai=product::where('promotion_price','<>',0)->get();
    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
    }
    public function getLoaiSp($type)
    {
        
        $sp_theoloai=product::where('id_type',$type)->get();
        $sp_khac=product::where('id_type','<>',$type)->paginate(3);

        $loai=typeProduct::all();
        $loai_sp=typeProduct::where('id',$type)->first();

        return view('page.loaisp',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }	
    public function getDetail(Request $request)
    {
        $sanpham = product::where('id', $request->id)->first();
        $splienquan = product::where('id', '<>', $sanpham->id, 'and', 'id_type', '=', $sanpham->id_type,)->paginate(3);
        $comments = comment::where('id_product', $request->id)->get();
        return view('page.chitietsp', compact('sanpham', 'splienquan', 'comments'));
    }
   
}


