@extends('admin.layouts.admin')

@section('title', '新增角色')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">新增角色</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" action="{{ url('adminApi/adminRole') }}" method="POST">
                        @include('admin.adminRole._form', ['form_type' => 'create'])

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">添加</button>
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