<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product; // Thêm dòng này để import mô hình Product
use App\Models\bill_detail; // Thêm dòng này để import mô hình BillDetail
use App\Models\Slide;

use App\Models\comment;


use App\Models\typeProduct;

class PageController extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
        //return view('page.trangchu',['slide'=>$slide]);
        $new_product = product::where('new', 1)->get();
        $sanpham_khuyenmai = product::where('promotion_price', '<>', 0)->get();
        return view('page.trangchu', compact('slide', 'new_product', 'sanpham_khuyenmai'));
    }
    public function getLoaiSp($type)
    {

        $sp_theoloai = product::where('id_type', $type)->get();
        $sp_khac = product::where('id_type', '<>', $type)->paginate(3);

        $loai = typeProduct::all();
        $loai_sp = typeProduct::where('id', $type)->first();

        return view('page.loaisp', compact('sp_theoloai', 'sp_khac', 'loai', 'loai_sp'));
    }
    public function getDetail(Request $request)
    {
        $sanpham = product::where('id', $request->id)->first();
        $splienquan = product::where('id', '<>', $sanpham->id, 'and', 'id_type', '=', $sanpham->id_type,)->paginate(3);
        $comments = comment::where('id_product', $request->id)->get();
        return view('page.chitietsp', compact('sanpham', 'splienquan', 'comments'));
    }
    public function getIndexAdmin()
    {
        $products = product::all();
        return view('pageadmin.admin', ['products' => $products, 'sumSold' => bill_detail::count()]);
    }
    public function getAdminAdd()
    {
        return view('pageadmin.formAdd');
    }
    public function postAdminAdd(Request $request)
    {
        $product = new Product();
        if ($request->hasFile('inputImage')) {
            $file = $request->file('inputImage');
            $fileName = $file->getClientOriginalName('inputImage');
            $file->move('source/image/product', $fileName);
        }
        $file_name = null;
        if ($request->file('inputImage') != null) {
            $file_name = $request->file('inputImage')->getClientOriginalName();
        }

        $product->name = $request->inputName;
        $product->image = $file_name;
        $product->description = $request->inputDescription;
        $product->unit_price = $request->inputPrice;
        $product->promotion_price = $request->inputPromotionPrice;
        $product->unit = $request->inputUnit;
        $product->new = $request->inputNew;
        $product->id_type = $request->inputType;
        $product->save();
        return $this->getIndexAdmin();
    }
    public function getAdminEdit($id)
    {
        $product = product::find($id);
        return view('pageadmin.formEdit')->with('product', $product);
    }
    public function postAdminEdit(Request $request)
    {
        $id = $request->editId;
        $product= product::find($id);
        if($request->hasFile('editImage')){
            $file = $request->file('editImage');
            $fileName = $file->getClientOriginalName('eidtImage');
            $file->move('source/image/product', $fileName);
        }
        if ($request->file('editImage') != null) {
            $product->image = $fileName;
        }
        $product->name = $request->editName;
        $product->description = $request->editDescription;
        $product->unit_price = $request->editPrice;
        $product->promotion_price = $request->editPromotionPrice;
        $product->unit = $request->editUnit;
        $product->new = $request->editNew;
        $product->id_type = $request->editType;
        $product->save();
        return $this->getIndexAdmin();
    }
public function postAdminDelete($id)
{
$product = product::find($id);
$product->delete();
return $this->getIndexAdmin();
}

};
