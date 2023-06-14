<?php

namespace App\Http\Controllers;
use App\Models\t_lazada1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ShowSP extends Controller
{
    public function getProducts()
    {
        $products = t_lazada1::all();
        return response()->json($products);
    }
    public function getOneProduct($id)
    {
        $product = t_lazada1::find($id);
        return response()->json($product);
    }
    public function addProduct(Request $request)
    {
        $product = new t_lazada1();
        $product->name = $request->input('name');
        $product->price = intval($request->input('price'));
        $product->image = $request->input('image');
        $product->shopowner = $request->input('shopowner');
        $product->save();
        return $product;
    }
    public function uploadImage(Request $request)
    {
        // process image							
        if ($request->hasFile('uploadImage')) {
            $file = $request->file('uploadImage');
            $fileName = $file->getClientOriginalName();

            $file->move('source/image/product', $fileName);

            return response()->json(["message" => "ok"]);
        } else return response()->json(["message" => "false"]);
    }
    // public function deleteProduct($id)
    // {
    //     $product = t_lazada1::find($id);
    //     $fileName = 'source/image/product/' . $product->image;
    //     if (File::exists($fileName)) {
    //         File::delete($fileName);
    //     }
    //     $product->delete();
    //     return ['status' => 'ok', 'msg' => 'Delete successed'];
    // }
}
