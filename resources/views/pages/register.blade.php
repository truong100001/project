@extends('master')

@section('content')
    @if(session('message'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Thông báo',
                text: "Đăng ký thành công vui lòng chờ tài khoản được duyệt",
            });
        </script>
    @endif
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="public_admin/images/icon/logo-tovi.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="{{asset('/register')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Họ và tên</label>
                                <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                @if($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ email</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                                @if($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input class="au-input au-input--full" type="text" name="phone" placeholder="Số điện thoại">
                                @if($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                @if($errors->has('password'))
                                    <div class="text-danger">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input class="au-input au-input--full" type="password" name="repassword" placeholder="Password">
                                @if($errors->has('repassword'))
                                    <div class="text-danger">{{ $errors->first('repassword') }}</div>
                                @endif
                            </div>

                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">Đăng ký</button>

                        </form>
                        <div class="register-link">
                            <p>
                                Tôi đã có tài khoản?
                                <a href="{{asset('/login')}}">Đăng nhập</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection