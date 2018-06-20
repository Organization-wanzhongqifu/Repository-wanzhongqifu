@extends('admin.layouts.admin')

@section('title', '编辑')

@section('content')
 <div class="row">

  <div class="col-md-12">
   <div class="box box-info">
    <div class="box-header with-border">
     <h3 class="box-title">编辑</h3>
    </div>
    <div class="box-body">
     <form class="form-horizontal" action="{{ url('adminApi/services/'.$row->id) }}" method="POST">
      @include('admin.service._form', ['form_type' => 'edit'])

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