@extends('layouts.frontend')

<title>Đăng nhập</title>
<meta charset="UTF-8">
<meta name="description" content="Login">
<meta name="keywords" content="login, sign">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@section('content')
    <div class="card col-lg col-xl-9 flex-row mx-auto px-0">
        <div class="img-left d-none d-md-flex"></div>

        <div class="card-body">
            <h4 class="title text-center mt-2 mb-3">Đăng nhập vào tài khoản của bạn</h4>
            <form class="form-box px-3"method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-input">
                    <span><i class="fa fa-envelope"></i></span>
                    <input type="email" name="email" placeholder="Email Address"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>

                    @error('email')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-input">
                    <span><i class="fa fa-key"></i></span>
                    <input type="password" name="password" placeholder="Password"
                        class="form-control @error('password') is-invalid @enderror" required
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback mt-3" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Lưu mật khẩu</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forget-link">Quên mật khẩu?</a>
                    @endif
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-block">Đăng nhập</button>
                </div>

                <hr class="my-4">
                </hr>

                <div class="text-center mb-2">
                    Chưa có tài khoản?
                    <a href="{{ route('register') }}" class="register-link">Đăng ký tại đây</a>
                </div>
            </form>
        </div>

    </div>
@endsection
