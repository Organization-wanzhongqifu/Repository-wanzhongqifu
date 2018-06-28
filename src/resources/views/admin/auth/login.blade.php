@extends('admin.layouts.base')

@section('title', '登录')

@section('css')
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/iCheck/square/blue.css') }}">
    <style>
        .login-page {
            background: #fff;
        }
        .login-box-body {
            padding-top: 20px;
            padding-bottom: 50px;
            box-shadow: 1px 1px 10px #dddddd;
        }
    </style>
@endsection

@section('body')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/admin') }}"><img height="59" width="221" src=" {{ asset('img/logo.png') }}" alt="万众企服"></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">登录</p>

            <form action="{{ url('adminApi/login') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback @if(session('errors.user')) has-error @endif">
                    <input id="user" type="text" name="user" class="form-control" value="{{ old('user') }}" placeholder="用户名">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if(session('errors.user'))
                        <span class="help-block">{{ session('errors.user') }}</span>
                    @endif
                </div>

                <div class="form-group has-feedback @if(session('errors.password')) has-error @endif">
                    <input id="password" type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="密码">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if(session('errors.password'))
                        <span class="help-block">{{ session('errors.password') }}</span>
                    @endif
                </div>

                <div class="row" style="margin-top: 30px;">
                    <div class="col-xs-12">
                        <button type="submit" disabled="disabled" id="login" class="btn btn-success btn-block">登录</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('static/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset('static/admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('static/admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
            //防止被嵌入子页面
            if(window.top != window)
            {
                window.top.location.href = document.location.href;
            }

            $('#user').on('input', function () {
                var user = $('#user').val();
                var pwd = $('#password').val();
                if (user && pwd) {
                    $('#login').prop('disabled', false)
                }
            });

            $('#password').on('input', function () {
                var user = $('#user').val();
                var pwd = $('#password').val();
                if (user && pwd) {
                    $('#login').prop('disabled', false)
                }
            });
        });
    </script>
    </body>
@endsection