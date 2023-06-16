<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\bill_detail;
use App\Models\Slide;
use App\Models\comment;
use App\Models\typeProduct;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;
use App\Models\customer;
use App\Models\bill;
use App\Models\Wishlist;


class PageController extends Controller
{
    public function getIndex()
    {
        $slide = Slide::all();
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
        $product = product::find($id);
        if ($request->hasFile('editImage')) {
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

    public function getAddToCart(Request $req, $id)
    {
        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        if (Session::has('users')) {
            // Kiểm tra xem sản phẩm có tồn tại hay không
            if (Product::find($id)) {
                // Tìm kiếm sản phẩm với ID tương ứng
                $product = Product::find($id);

                // Lấy giỏ hàng hiện tại từ session hoặc gán giá trị null nếu không tồn tại
                $oldCart = Session('cart') ? Session::get('cart') : null;

                // Tạo một đối tượng Cart mới và khởi tạo giỏ hàng mới
                $cart = new Cart($oldCart);

                // Thêm sản phẩm vào giỏ hàng
                $cart->add($product, $id);

                // Đặt giỏ hàng mới vào session
                $req->session()->put('cart', $cart);

                // Chuyển hướng người dùng trở lại trang trước đó
                return redirect()->back();
            } else {
                // Hiển thị thông báo lỗi và chuyển hướng về trang chủ nếu không tìm thấy sản phẩm
                return '<script>alert("Không tìm thấy sản phẩm này.");window.location.assign("/");</script>';
            }
        } else {
            // Hiển thị thông báo yêu cầu đăng nhập và chuyển hướng đến trang đăng nhập nếu người dùng chưa đăng nhập
            return '<script>alert("Vui lòng đăng nhập để sử dụng chức năng này.");window.location.assign("/login");</script>';
        }
    }

    
    public function getDelItemCart($id)
    {
        // Lấy giỏ hàng hiện tại từ session hoặc gán giá trị null nếu không tồn tại
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        // Tạo một đối tượng Cart mới và khởi tạo giỏ hàng mới
        $cart = new Cart($oldCart);

        // Xóa một mục khỏi giỏ hàng dựa trên ID của sản phẩm
        $cart->removeItem($id);

        // Kiểm tra xem giỏ hàng còn có mục hàng nào hay không
        if (count($cart->items) > 0) {
            // Nếu còn, đặt giỏ hàng mới vào session
            Session::put('cart', $cart);
        } else {
            // Nếu không còn, xóa khóa 'cart' khỏi session
            Session::forget('cart');
        }

        // Chuyển hướng người dùng trở lại trang trước đó
        return redirect()->back();
    }

    public function getCheckout()
    {
        if (Session::has('cart')) {
            // Kiểm tra xem có giỏ hàng trong session hay không

            $oldCart = Session::get('cart');
            // Lấy giỏ hàng hiện tại từ session

            $cart = new Cart($oldCart);
            // Tạo một đối tượng Cart mới và khởi tạo giỏ hàng mới

            return view('page.checkout')->with([
                'cart' => Session::get('cart'),
                'product_cart' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty
            ]);
            // Trả về view 'page.checkout' với các thông tin sau:
            // - 'cart': Giỏ hàng trong session
            // - 'product_cart': Danh sách mục hàng trong giỏ hàng
            // - 'totalPrice': Tổng giá trị của giỏ hàng
            // - 'totalQty': Tổng số lượng mục hàng trong giỏ hàng
        } else {
            return redirect('/master');
            // Nếu không có giỏ hàng trong session, chuyển hướng đến trang '/master'
        }
    }


    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');
        // Lấy giỏ hàng từ session

        $customer = new Customer;
        // Tạo một đối tượng customer mới

        $customer->name = $req->full_name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        // Gán các thông tin khách hàng từ dữ liệu yêu cầu (form)

        if (isset($req->notes)) {
            $customer->note = $req->notes;
        } else {
            $customer->note = "Không có ghi chú gì";
        }
        // Kiểm tra xem có ghi chú được nhập vào hay không, và gán giá trị tương ứng

        $customer->save();
        // Lưu thông tin khách hàng vào cơ sở dữ liệu

        $bill = new Bill;
        // Tạo một đối tượng bill mới

        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        // Gán thông tin đơn hàng từ dữ liệu yêu cầu (form)

        if (isset($req->notes)) {
            $bill->note = $req->notes;
        } else {
            $bill->note = "Không có ghi chú gì";
        }
        // Kiểm tra xem có ghi chú được nhập vào hay không, và gán giá trị tương ứng

        $bill->save();
        // Lưu thông tin đơn hàng vào cơ sở dữ liệu

        foreach ($cart->items as $key => $value) {
            $bill_detail = new bill_detail;
            // Tạo một đối tượng bill_detail mới

            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            // Gán thông tin chi tiết đơn hàng từ giỏ hàng

            $bill_detail->save();
            // Lưu thông tin chi tiết đơn hàng vào cơ sở dữ liệu
        }

        Session::forget('cart');
        // Xóa giỏ hàng khỏi session

        $wishlists = Wishlist::where('id_user', Session::get('users')->id)->get();
        // Lấy danh sách các wishlist của người dùng hiện tại từ session

        if (isset($wishlists)) {
            // Kiểm tra xem có danh sách wishlist hay không

            foreach ($wishlists as $element) {
                $element->delete();
                // Xóa các wishlist
            }
        }
    }
};
