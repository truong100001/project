<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,[
            'email' => 'bail|required|email',
            'password' => 'bail|required'
        ],[
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống'
        ]);

        if(Auth::attempt(['email' => $request->email,'password' => $request->password],$request->remember))
        {
            if(Auth::user()->access == 0)
                {
                Auth::logout();
                return redirect()->back()->with('message1','Tài khoản của bạn chưa có quyền truy cập');
            }
            return redirect('/');
        }
        else
        {
            return redirect()->back()->with('message2','Email hoặc mật khẩu không chính xác');
        }
    }


    public function register()
    {
        return view('pages.register');
    }

    public function postRegister(Request $request)
    {
        $this->validate($request,[
            'username' => 'bail|required|max:50',
            'email' => 'bail|required|email',
            'phone' => 'bail|required|numeric',
            'password' => 'bail|required|min:3',
            'repassword' => 'bail|required|same:password'
        ],[
            'username.required' => 'Họ và tên không được để trống',
            'username.max:50' => 'Họ và tên tối đa 50 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại không hợp lệ',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu ít nhất 3 ký tự',
            'repassword.required' => 'Nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu nhập lại không đúng'
        ]);

        DB::table('users')->insert([
            'name' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 0,
            'access' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','success');

    }


    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
            return redirect('/login');
        }

    }
}
