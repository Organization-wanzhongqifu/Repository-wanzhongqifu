@extends('admin.layouts.admin')

@section('title', '新增')

@section('content')
 <div class="row">

  <div class="col-md-12">
   <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">新增</h3>
    </div>
    <div class="box-body">
     <form class="form-horizontal" action="{{ url('adminApi/slides') }}" method="POST">
      @include('admin.slide._form', ['form_type' => 'create'])

      <div class="form-group">
        <div class="col-md-7 col-md-offset-3">
          <button type="submit" class="btn btn-success">提交</button>
        </div>
      </div>

     </form>
    </div>
   </div>
  </div>
 </div>
@endsection