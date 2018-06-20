@extends('admin.layouts.admin')

@section('title', '重设密码')

@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">重设密码</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ url('adminApi/admin/reset') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="POST">

                        <div class="form-group @if($errors->has('password')) has-error @endif">
                            <label for="password" class="col-md-3 control-label">新密码</label>
                            <div class="col-md-5">
                                <input type="password" name="password" id="password" class="form-control" value="">
                                @if($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @if($errors->has('password_confirmation')) has-error @endif">
                            <label for="password_confirmation" class="col-md-3 control-label">重复密码</label>
                            <div class="col-md-5">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                                @if($errors->has('password_confirmation'))
                                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-success">提交</button>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
@endsection