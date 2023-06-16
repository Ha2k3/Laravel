<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        // Lấy email và mật khẩu từ biểu mẫu đăng nhập
        $login = [
            'email' => $request->input('email'),
            'password' => $request->input('pw')
        ];

        // Thử xác thực người dùng bằng thông tin đăng nhập
        if (Auth::attempt($login)) {
            // Nếu xác thực thành công, lấy thông tin người dùng đã xác thực
            $users = Auth::user();

            // Lưu dữ liệu người dùng vào session
            Session::put('users', $users);

            // Hiển thị thông báo thành công và chuyển hướng đến trang "/master" bằng JavaScript
            echo '<script>alert("Đăng nhập thành công."); window.location.assign("/master");</script>';
        } else {
            // Nếu xác thực thất bại, hiển thị thông báo lỗi và chuyển hướng trở lại trang "login" bằng JavaScript
            echo '<script>alert("Đăng nhập thất bại."); window.location.assign("login");</script>';
        }
    }


    public function Logout()
    {
        Session::forget('users');
        Session::forget('cart');
        return redirect('/master');
    }
    public function Register(Request $request)
    {
        // Lấy dữ liệu từ biểu mẫu đăng ký và thực hiện kiểm tra dữ liệu
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        // Mã hóa mật khẩu sử dụng hàm bcrypt
        $input['password'] = bcrypt($input['password']);

        // Tạo một người dùng mới trong cơ sở dữ liệu
        User::create($input);

        // Hiển thị thông báo đăng ký thành công và chuyển hướng đến trang "login" bằng JavaScript
        echo '
    <script>
    alert("Đăng ký thành công. Vui lòng chọn đăng nhập");
    window.location.assign("login");
    </script>
    ';
    }
}
