<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('mobile/style/lib/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('mobile/style/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('mobile/style/lib/iconfont.css') }}">
    @yield('dk')
    <title>@yield('title', '工商代办_公司注册_代理记账_代办营业执照-万众企服')</title>
    @yield('css')
    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?a90b2fb29cc816bf7ff0eaa532602fb7";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</head>

<body>
<div class="header">
    <a href="{{ url('/wap') }}" class="">
        <i class="icon icon-home"></i>
    </a>
    <a href="{{ url('/wap') }}">
        @yield('sub_title') </a>
    <a href="javascript:;" class="mene-toggle">
            <i class="icon icon-menu"></i>
        </a>
        <div class="header-menu">
            <ul>
                <li>
                    <b>导航菜单</b>
                </li>
                <li>
                    <a href="{{ url('/wap') }}">
                        <img src="{{ asset('mobile/images/icon34.png') }}"> 首页</a>
                </li>
                @foreach($menus as $menu)
                    <li>
                        <a href="{{ $menu->url }}">
                            <img src="{{ asset('mobile/images/icon35.png') }}"> {{ $menu->name }}</a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ url('/wap/services') }}">
                        <img src="{{ asset('mobile/images/icon39.png') }}"> 服务商入驻</a>
                </li>
                <li>
                    <a href="{{ url('/wap/about') }}">
                        <img src="{{ asset('mobile/images/icon40.png') }}"> 关于我们</a>
                </li>
            </ul>
        </div>
</div>
@yield('content')
<div class="footer base">
    <div class="footer-menu">
        <a  onclick="_hmt.push(['_trackEvent', '手机在线咨询', '点击', '弹窗'])"  href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow">在线咨询</a>
        <!-- <a href="" data-toggle="modal" data-target="#Modal02" data-backdrop="static">服务商入驻</a> -->
        <a  onclick="_hmt.push(['_trackEvent', '手机电话咨询', '点击', ''])"  href="tel:4000391818">电话咨询</a>
    </div>
</div>
<!-- Modal -->
<input type="hidden" name="service_province01">
<input type="hidden" name="service_city01">
<input type="hidden" name="service_district01">
<input type="hidden" name="service_province02">
<input type="hidden" name="service_city02">
<input type="hidden" name="service_district02">
<div class="modal fade query-modal" id="Modal01" tabindex="-1" role="dialog" aria-labelledby="Modal01Label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ModalLabel">请留下联系方式，我们会尽快回复您查询结果</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" data-toggle="validator" id="form01">
                    <div class="form-group">
                        <label for="" class="col-xs-3 control-label">企业名称：</label>
                        <div class="col-xs-9">
                            <input type="text" class="form-control" name="company_name" id="company_name" placeholder="例如：百度网络科技公司" required> </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-xs-3 control-label">服务区域：</label>
                        <div class="col-xs-9">
                            <div class="row city-select" id="city_china01">
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
                                <input type="tel" name="mobile" class="form-control" id="" placeholder="" required pattern="^1(3|4|5|7|8)[0-9]\d{8}$" maxlength="11" data-error="请输入正确的手机号码！">
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
                           <div class="has-placeholder-label">
                                <input type="text" name="name" class="form-control" id="" placeholder="">
                                <label for="" class="placeholder-label">请输入您的姓名
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-default btn-block approval_submit">免费核名</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade join-modal" id="Modal02" tabindex="-1" role="dialog" aria-labelledby="Modal02Label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="join-box">
                    <form role="form" data-toggle="validator" id="form02">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="icon icon19"></i>
                                </div>
                                <input type="text" class="form-control" id="exampleInputAmount" name="company_name02" placeholder="请输入您的公司名称" data-error="请输入您的公司名称！" required> </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group selects">
                                <div class="input-group-addon">
                                    <i class="icon icon20"></i>
                                </div>
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
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="icon icon21"></i>
                                </div>
                                <input type="text" class="form-control" id="exampleInputAmount" name="name02" placeholder="请输入您的姓名" data-error="请输入您的姓名！"  required> </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="icon icon22"></i>
                                </div>
                                <input type="tel" class="form-control" id="exampleInputAmount" name="mobile02" placeholder="请输入您的手机号码" data-error="请输入正确的手机号码！" required pattern="^1(3|4|5|7|8)[0-9]\d{8}$" maxlength="11"> </div>
                            <div class="help-block with-errors"></div>
                        </div>
                        <button  onclick="_hmt.push(['_trackEvent', '手机立即入驻', '点击', '入驻提交'])"  type="submit" class="join-btn enterprise">立即入驻</button>
                        <br>
                        <p class="text-right">
                            <a  onclick="_hmt.push(['_trackEvent', '手机立即咨询', '点击', '跳转'])" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow">立即咨询 &raquo;</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade alert-modal" id="Modal03" tabindex="-1" role="dialog" aria-labelledby="Modal03Label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ModalLabel">温馨提示</h4>
            </div>
            <div class="modal-body">
                <img src="{{ asset('mobile/images/icon33.png') }}" class="alert-icon">
                <h3>提交成功</h3>
                <p>您的申请我们已经收到  <br> 
                    请耐心等待，我们会尽快与您取得联系。</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn" data-dismiss="modal">好的</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade alert-modal" id="Modal04" tabindex="-1" role="dialog" aria-labelledby="Modal04Label">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="ModalLabel">温馨提示</h4>
            </div>
            <div class="modal-body">
                <img src="{{ asset('mobile/images/icon32.png') }}" class="alert-icon">
                <h3>提交成功</h3>
                <p>您的申请我们已经收到  <br> 
                    专业财税顾问会在第一时间与您联系。</p>
            </div>
            <div class="modal-footer">
                <a href="" class="btn btn-blue" data-dismiss="modal">好的</a>
            </div>
        </div>
    </div>
</div>

<!-- 固定的电话按钮 -->
<!-- <div class="fixTel" style="width: 70px;height: 70px;background: #F47F29;border-radius: 50%;position: fixed;right: 20px;bottom: 20%;">
    <a href="tel:4000391818" style="color:#000;">
        <i class="icon iconfont icon-dianhua" style="margin-left: 21px;"></i>
        <p style="text-align: center;margin-top: -0.15rem;color: #330a0a;font-size: 15px;">电话</p> 
    </a>
</div> -->

<div class="side-btn clearfloat" id="slide-btn">
    <div class="online">
        <a  onclick="_hmt.push(['_trackEvent', '手机在线咨询', '点击', '弹窗'])"  href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow" class="open-online-chat">
            <span></span>
            <p>咨询</p>
        </a>
    </div>
    <div class="telephone">
        <a  onclick="_hmt.push(['_trackEvent', '手机电话咨询', '点击', ''])"  href="tel:4000391818" class="mobile-index-phone">
            <span></span>
            <p>电话</p>
        </a>
    </div>
    <div class="back-top">
        <a href="javascript:void(0);">
            <span></span>
        </a>
    </div>
</div>

<!-- script -->
<script src="{{ asset('mobile/js/lib/jquery.min.js') }}"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('mobile/js/lib/jquery.SuperSlide.2.1.1.js') }}"></script>
<script src="{{ asset('mobile/js/lib/jquery.citys.js') }}"></script>
<script src="{{ asset('mobile/js/lib/validator.min.js') }}"></script>
<script src="{{ asset('mobile/js/lib/slick.min.js') }}"></script>
<script src="{{ asset('mobile/js/app.js') }}"></script>
<script>
    // 企业核名请求提交
    $('.approval_submit').on('click', function () {
        if (!$(this).hasClass('disabled')) {
            var approval = {};
            approval.city = '';
            approval.company_name = $('input[name=company_name]').val();
            approval.service_province = $('input[name=service_province01]').val();
            approval.service_city = $('input[name=service_city01]').val();
            approval.service_district = $('input[name=service_district01]').val();
            approval.name = $('input[name=name]').val();
            approval.mobile = $('input[name=mobile]').val();
            approval.origin_from = 1;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/adminApi/approvals/submit',
                data: approval
            }).done(function (data) {
                $('#Modal03').modal('show');
                $('#Modal01').modal('hide');
            });
        }
    });
    // 企业服务请求提交
    $('.enterprise').on('click', function () {
        if (!$(this).hasClass('disabled')) {
            var enterprise = {};
            enterprise.company_name = $('input[name=company_name02]').val();
            enterprise.address_province = $('input[name=service_province02]').val();
            enterprise.address_city = $('input[name=service_city02]').val();
            enterprise.address_district = $('input[name=service_district02]').val();
            enterprise.name = $('input[name=name02]').val();
            enterprise.mobile = $('input[name=mobile02]').val();
            enterprise.origin_from = 1;
            console.log(enterprise);
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
                $('#Modal03').modal('show');
                $('#Modal02').modal('hide');
            });
        }
    });
</script>

<script type="text/javascript">
    var cnzz_s_tag = document.createElement('script');
    cnzz_s_tag.type = 'text/javascript';
    cnzz_s_tag.async = true;
    cnzz_s_tag.charset = "utf-8";
    cnzz_s_tag.src = "http://w.cnzz.com/c.php?id=1273245099&async=1";
    var root_s = document.getElementsByTagName('script')[0];
    root_s.parentNode.insertBefore(cnzz_s_tag, root_s);
</script>

@yield('js')
</body>

</html>