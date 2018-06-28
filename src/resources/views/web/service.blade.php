@extends('web.layouts.base')

@section('dk')
<meta name="description" content="万众企服平台致力于中小微企业服务,为您提供有限公司注册,企业注册,代办公司注册等服务.涉及范围覆盖全国,服务企业用户超过60万家,受到用户一致好评.若您有有限公司注册,企业注册,代办公司注册,注册公司费用咨询需求请拨打电话4000391818！" />
<meta name="keywords" content="有限公司注册,企业注册,代办公司注册,注册公司费用" />
@endsection

@section('title')@parent有限公司注册_企业注册_代办公司注册_注册公司费用-万众企服@stop

@section('css')
    <style>
        .detail-content p,
        .detail-content img {
            padding: 0;
            margin: 0;
        }
        .detail-content img {
            width: 100%;
        }
    </style>
@endsection

@section('js')
    <script>
        // 企业服务请求提交
        $('.submit').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var provider = {};
                provider.specification_id = $('input[name=sid]').val();
                provider.service_id = $('input[name=service_id]').val();
                provider.service_province = $('input[name=service_province]').val();
                provider.service_city = $('input[name=service_city]').val();
                provider.service_district = $('input[name=service_district]').val();
                provider.name = $('input[name=name]').val();
                provider.mobile = $('input[name=mobile]').val();
                provider.origin_from = 1;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/adminApi/providers/submit',
                    data: provider
                }).done(function (data) {
                    $('#Modal02').modal('show');
                });
            }
        });
        // 选择
        $('.intro-link').on('click', function () {
            var _price = $(this).data('price');
            var _id = $(this).data('id');
            $('.intro-link').removeClass('active');
            $(this).addClass('active');
            $('.intro-price').text(_price);
            $('input[name=sid]').val(_id);
        });
    </script>
@endsection

@section('content')
    <input type="hidden" name="sid" value="{{ $specifications[0]->id }}">
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <div class="detail-intro">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ url('/') }}">首页</a>
                </li>
                <li class="active">{{ $service->name }}</li>
            </ol>
            <div class="row">
                <div class="col-xs-4">
                    <div class="intro-img">
                        <img src="{{ asset($service->thumb) }}"> </div>
                </div>
                <div class="col-xs-8">
                    <div class="intro-content">
                        <h1 style="font-size: 27px;font-weight: bold;margin-top: 0;margin-bottom: 15px;">{{ $service->name }}</h1>
                        <dl class="has-bg">
                            <dt>价格：</dt>
                            <dd class="intro-price">
                                {{$specifications[0]->price}}
                            </dd>
                        </dl>
                        <dl>
                            <dt>名 称：</dt>
                            <dd>
                                @foreach($specifications as $key => $specification)
                                <a href="javascript:;" data-price="{{ $specification->price }}" data-id="{{ $specification->id }}" class="intro-link @if($key == 0) active @endif">{{ $specification->name }}</a>
                                @endforeach
                            </dd>
                        </dl>
                        <hr>
                        <dl>
                            <dt></dt>
                            <dd>
                                <a onclick="_hmt.push(['_trackEvent', '我要服务', '点击', '弹窗'])"  class="btn btn-buy" data-toggle="modal" data-target="#Modal01">我要服务</a>
                                <a onclick="_hmt.push(['_trackEvent', '立即咨询', '点击', '弹窗'])"  target="_blank" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow" class="btn btn-contact">立即咨询</a>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail-content">
        <div class="cell">
            <div class="container">
                {!! $service->pc_text !!}
            </div>
        </div>

    </div>
@endsection