@extends('admin.layouts.base')

@section('body')
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
   page. However, you can choose any other skin. Make sure you
   apply the skin class to the body tag so the changes take effect.
-->
<link rel="stylesheet" href="{{ asset('static/admin/dist/css/skins/'.config('fc_admin.skin').'.css') }}">

<!--
    load css
-->
<link href="{{ asset('static/admin/dist/css/load/load.css') }}" rel="stylesheet">

<body class="hold-transition {{config('fc_admin.skin')}} sidebar-mini">

<!-- 加载 -->
<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div>

<!-- Notify -->


<div class="wrapper">

    <!-- Main Header -->
    @include('admin.layouts.mainHeader')

    <!-- Left side column. contains the logo and sidebar -->
    @include('admin.layouts.mainSidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- 面包屑 -->
        <section class="content-header">
            {{ createBreadCrumb($breadcrumbs) }}
            @yield('breadcrumb')
        </section>

        <!-- 主体内容区 -->
        <section class="content">

            <!-- 提示消息 -->
            <div class="row">
                <div class="box-body">
                    @if(session('prompt'))
                        @include('admin.layouts.prompt')
                    @endif
                </div>
            </div>

            @yield('content')
        </section>

    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    @include('admin.layouts.mainFooter')
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="{{ asset('static/admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('static/admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('static/admin/dist/js/app.min.js') }}"></script>
<script src="{{ asset('static/admin/js/jquery.cookie.js') }}"></script>
<!-- layer弹窗 -->
<script src="{{ asset('static/admin/js/layer/layer.js') }}"></script>
<script src="{{ asset('static/admin/js/flycorn.js') }}"></script>
<script src="{{ asset('static/admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('static/admin/plugins/datepicker/locales/bootstrap-datepicker.zh-CN.js') }}"></script>
<script src="{{ asset('static/admin/plugins/lightbox2/js/lightbox.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('static/admin/plugins/datepicker/datepicker3.css') }}">
<script src="{{ asset('static/admin/plugins/My97DatePicker/WdatePicker.js') }}"></script>
<script src="{{ asset('static/admin/js/jquery.citys.js') }}"></script>
<script src="{{ asset('static/admin/js/distpicker.min.js') }}"></script>
<script src="{{ asset('static/admin/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script>
//页面加载
window.onload = function(){
    loadShow(0);
};
$(document).ready(function(){

    // 防止重复提交
    $('form').submit(function() {
        $('button[type=submit]').attr('disabled', true);
    });

    if ($('.prompt').length > 0) {
        setTimeout(function () {
            $('.prompt').hide();
        }, 2000);
    }

    loadShow(1);
    $(".datepicker").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        language: 'zh-CN'
    });
    $('.WdatePicker').click(function () {
        WdatePicker({el:this,dateFmt:'yyyy-MM-dd HH:mm:ss'});
    });
    $('body').on('input', "input[type='text']", function () {
        $(this).siblings('.help-block').hide();
        $(this).parent().parent().removeClass('has-error');
    });
    $('body').on('blur', "input[type='text']", function () {
        $(this).siblings('.help-block').hide();
        $(this).parent().parent().removeClass('has-error');
    });
    $('body').on('input', "textarea", function () {
        $(this).siblings('.help-block').hide();
        $(this).parent().parent().removeClass('has-error');
    });

    $('.file-upload').on('click', function () {
        var html_id = $(this).attr('id');

        var width = $(this).data('width');
        var height = $(this).data('height');

        console.log(html_id + '@' + width + '@' + height);

        //上传组件
        fc_upload_img("#" + html_id,
            {
                url: "{{url('adminApi/upload/image')}}",
                param: {type: 0, key: html_id + '_upload', width: width, height: height, gif: 0},
                beforeUpload: function(){ loadShow() },
                afterUpload: function(){
                    loadShow(0);
                    $('input[name=type]').remove();
                    $('input[name=key]').remove();
                }
            }, function(res){
                $('#fc_upload_form').remove();
                if(res.status <= 0){
                    fc_msg(res.msg, 0);
                    return;
                } else {
                    $('.' + html_id).show();
                    $('.' + html_id).attr('href', res.data.img_url);
                    $('input[name=' + html_id + ']').val(res.data.img);
                }
            });
    });
});
</script>
</body>
@endsection

