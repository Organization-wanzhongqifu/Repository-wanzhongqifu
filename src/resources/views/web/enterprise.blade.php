@extends('web.layouts.base')

@section('dk')
<meta name="description" content="万众企服是一家致力于中小企业工商代办,公司注册,代理记账,代办营业执照等服务的一站式智能企业服务平台.服务范围覆盖全国,服务企业用户超过60万家,服务项目包括工商代办,公司注册,代理记账,代办营业执照,商标注册等。" />
<meta name="keywords" content="立即入驻,入驻万众企服" />
@endsection

@section('title')@parent欢迎入驻万众企服！@stop

@section('js')
    <script>
        // 企业服务请求提交
        $('.enterprise').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var enterprise = {};
                enterprise.company_name = $('input[name=company_name]').val();
                enterprise.address_province = $('input[name=service_province]').val();
                enterprise.address_city = $('input[name=service_city]').val();
                enterprise.address_district = $('input[name=service_district]').val();
                enterprise.name = $('input[name=name]').val();
                enterprise.mobile = $('input[name=mobile]').val();
                enterprise.origin_from = 1;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/adminApi/enterprises/submit',
                    data: enterprise
                }).done(function (data) {
                    $('#form03').find("input, textarea, select").val("");
                    $('#Modal03').modal('show');
                });
            }
        });
    </script>
@endsection

@section('content')
    <div class="service-banner" style="background-image: url({{ asset('web/pic/banner-service.jpg')}});">
        <div class="container">
            <div class="join-box" id="joinBox">
                <form role="form" data-toggle="validator" id="form03">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon icon19"></i>
                            </div>
                            <input type="text" class="form-control" name="company_name" placeholder="请输入您的公司名称" data-error="请输入您的公司名称！" required> </div>
                            <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group selects">
                            <div class="input-group-addon">
                                <i class="icon icon20"></i>
                            </div>
                            <div class="row city-select" id="city_china">
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
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon icon21"></i>
                            </div>
                            <input type="text" class="form-control" name="name" placeholder="请输入您的姓名" data-error="请输入您的姓名！" required> </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="icon icon22"></i>
                            </div>
                            <input type="tel" class="form-control" name="mobile" placeholder="请输入您的手机号码" data-error="请输入正确的手机号码！" required pattern="^1(3|4|5|7|8)[0-9]\d{8}$" maxlength="11"> </div>
                        <div class="help-block with-errors"></div>
                    </div>
                    <button onclick="_hmt.push(['_trackEvent', '立即入驻', '点击', '提交'])" type="submit" class="join-btn btn enterprise" >立即入驻</button>
                    <br>
                    <p class="text-right">
                        <a target="_blank"  onclick="_hmt.push(['_trackEvent', '立即咨询', '点击', '弹窗'])" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow">立即咨询 &raquo;</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <div class="cell has-bg">
        <div class="container">
            <h3 class="cell-title">合作流程</h3>
            <div class="row service-flow">
                <div class="col-xs-4">
                    <i class="icon icon23"></i> 平台全渠道获客 </div>
                <div class="col-xs-4">
                    <i class="icon icon24"></i> 平台分配客户 </div>
                <div class="col-xs-4">
                    <i class="icon icon25"></i> 服务商签单 </div>
            </div>
        </div>
    </div>
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">平台优势</h3>
            <div class="row service-advantage text-center">
                <div class="col-xs-3">
                    <i class="icon icon31"></i>
                    <h4>强大的获客资源</h4>
                    <p>全网中小微企业
                        <br> 服务需求资源共享</p>
                </div>
                <div class="col-xs-3">
                    <i class="icon icon26"></i>
                    <h4>覆盖全国200+城市</h4>
                    <p>需求与供应的打通
                        <br> 架起企业和服务商的桥梁</p>
                </div>
                <div class="col-xs-3">
                    <i class="icon icon27"></i>
                    <h4>统一标准的品牌标志</h4>
                    <p>加入万众企服，成为平台
                        <br> 认证服务商，扩大品牌影响力 </p>
                </div>
                <div class="col-xs-3">
                    <i class="icon icon28"></i>
                    <h4>无竞争化合作机制</h4>
                    <p>平台不直接提供服务，没
                        <br> 有竞争关系才能真正实现共赢 </p>
                </div>
            </div>
            <a class="join-btn btn" href="#joinBox"> 立即入驻 </a>
        </div>
    </div>
@endsection