@extends('wap.layouts.base')

@section('dk')
<meta name="description" content="万众企服平台致力于中小微企业服务,为您提供有限公司注册,企业注册,代办公司注册等服务.涉及范围覆盖全国,服务企业用户超过60万家,受到用户一致好评.若您有有限公司注册,企业注册,代办公司注册,注册公司费用咨询需求请拨打电话4000391818！" />
<meta name="keywords" content="有限公司注册,企业注册,代办公司注册,注册公司费用" />
@endsection

@section('title')@parent有限公司注册_企业注册_代办公司注册_注册公司费用-万众企服@stop

@section('css')
    <style>
        .footer.base {
            display: none;
        }
    </style>
@endsection

@section('js')
    <script>
        // 企业服务请求提交
        $('.services').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var provider = {};
                provider.specification_id = $('input[name=sid]').val();
                provider.service_id = $('input[name=service_id]').val();
                provider.service_province = $('input[name=service_province02]').val();
                provider.service_city = $('input[name=service_city02]').val();
                provider.service_district = $('input[name=service_district02]').val();
                provider.name = $('input[name=name03]').val();
                provider.mobile = $('input[name=mobile03]').val();
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
                    $('#Modal03').modal('hide');
                    $('#Modal04').modal('show');
                });
            }
        });

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

@section('sub_title')
    <span class="title">{{ $service->name }}</span>
@endsection

@section('content')
    <input type="hidden" name="sid" value="{{ $specifications[0]->id }}">
    <input type="hidden" name="service_id" value="{{ $service->id }}">
    <div class="detail-intro">
        <div class="intro-img">
            <img src="{{ asset($service->thumb) }}">
        </div>
        <div class="intro-content">
            <h1 style="font-size: 15px;font-weight: bold;margin-top:0;margin-bottom: 15px;">{{ $service->name }}</h1>
            <dl class="has-bg">
                <dt>价格：</dt>
                <dd class="intro-price">
                    {{$specifications[0]->price}}
                </dd>
            </dl>
            <dl>
                <dt>类型：</dt>
                <dd>
                    @foreach($specifications as $key => $specification)
                        <a href="javascript:;" data-price="{{ $specification->price }}" data-id="{{ $specification->id }}" class="intro-link @if($key == 0) active @endif">{{ $specification->name }}</a>
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>
    <div class="detail-content">
        <div class="cell">
            <div class="container">
                {!! $service->wap_text !!}
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="footer-contact">
            <a href=""  onclick="_hmt.push(['_trackEvent', '手机我要服务', '点击', '弹窗'])"  class="btn-buy" data-toggle="modal" data-target="#Modal03" data-backdrop="static">我要服务</a>
            <a onclick="_hmt.push(['_trackEvent', '手机立即咨询', '点击', '跳转'])" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow" class="btn-contact">立即咨询</a>
        </div>
    </div>
    <div class="modal fade query-modal" id="Modal03" tabindex="-1" role="dialog" aria-labelledby="Modal03Label">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="ModalLabel">请留下联系方式，专业财税顾问正在马不停蹄的赶来为您服务</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" data-toggle="validator" id="form03">
                        <div class="form-group">
                            <label for="" class="col-xs-3 control-label">服务区域：</label>
                            <div class="col-xs-9">
                                <div class="row city-select" id="city_china02">
                                    <div class="city-item">
                                        <select class="form-control" name="province">
                                            <option>选择省份</option>
                                        </select>
                                    </div>
                                    <div class="city-item">
                                        <select class="form-control" name="city">
                                            <option>选择城市</option>
                                        </select>
                                    </div>
                                    <div class="city-item">
                                        <select class="form-control" name="area">
                                            <option>选择区县</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-xs-3 control-label">联系方式：</label>
                            <div class="col-xs-9">
                                <div class="has-placeholder-label">
                                <input type="text" name="mobile03" class="form-control" id="" placeholder="" required pattern="^1(3|4|5|7|8)[0-9]\d{8}$" data-error="请输入正确的手机号码！" maxlength="11"> 
                                <label for="" class="placeholder-label">请留下您的手机号码
                                        <em>（必填项*）</em>
                                    </label>
                                </div>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-xs-3 control-label">联系称呼：</label>
                            <div class="col-xs-9">
                                <input type="text" class="form-control" name="name03" placeholder="请输入您的姓名"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button onclick="_hmt.push(['_trackEvent', '手机我要服务', '点击', '提交'])" type="submit" class="btn btn-default btn-block services">我要服务</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection