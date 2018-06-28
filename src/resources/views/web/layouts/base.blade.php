<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="_token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('web/style/style.css') }}">
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
    <div class="header-top">
        <div class="container">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('web/images/logo.png') }}" alt=""></a>
        </div>
    </div>
    <div class="header-content">
        <div class="container">
            <div class="menu-warp">
                <a href="" class="menu-link">
                    <i class="icon icon-menu"></i>全部服务分类</a>
                <div class="menu-list @if(\Request::route()->getName() == 'homepage') show @else hide @endif">
                    <ul class="menu-intro">
                        @foreach($categories as $category)
                        <li class="mainCate">
                            <a href="">
                                <i class="icon" style="background-image: url({{ asset($category->icon) }})"></i>{{ $category->name }}</a>
                            @if(isset($category->sub))
                            <div class="subCate" style="width: 700px;">
                                @foreach($category->sub as $item)
                                <div class="cat-nav">
                                    @foreach($item as $value)
                                    <a href="{{ url($value->route) }}" @if($value->highlight == 1)class="hot"@endif>{{ $value->name }}</a>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="header-phone pull-right">
                <i class="icon icon-phone"></i> 400-039-1818 </div>
            <ul class="header-menu pull-right">
                <li @if(Route::currentRouteName() === 'homepage') class="active" @endif>
                    <a href="{{ url('/') }}">首页</a>
                </li>
                @foreach($menus as $menu)
                <li @if(url()->current() === $menu->url) class="active" @endif>
                    <a href="{{ $menu->url }}">{{ $menu->name }}</a>
                </li>
                @endforeach
                <li @if(Route::currentRouteName() === 'about') class="active" @endif>
                    <a href="{{ url('/about') }}">关于我们</a>
                </li>
                <li @if(Route::currentRouteName() === 'services') class="active" @endif>
                    <a href="{{ url('/services') }}">服务商入口</a>
                </li>
            </ul>
        </div>
    </div>
</div>

@yield('indexBanner')

@yield('content')

<div class="footer">
    <div class="container">
        <div class="footer-menu">
            <dl>
                <dt>关于万众企服</dt>
                <dd>
                    <a href="{{ url('/about') }}" rel="nofollow">了解我们</a>
                </dd>
                <dd>
                    <a href="{{ url('/about#contact') }}" rel="nofollow">联系我们</a>
                </dd>
            </dl>
            <dl>
                <dt>商务合作</dt>
                <dd>
                    <a href="{{ url('/about#contact') }}" rel="nofollow">商务合作</a>
                </dd>
            </dl>
            <dl>
                <dt>服务商</dt>
                <dd>
                    <a href="{{ url('/services') }}" rel="nofollow">申请服务商入驻</a>
                </dd>
            </dl>
        </div>
        <dl class="support">
            <dt>服务支持</dt>
            <dd>
                <a href="tel:4000391818" rel="nofollow">400-039-1818</a>
            </dd>
            <dd>
                <a class="support-btn" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow">售后服务</a>
            </dd>
        </dl>
    </div>
    <div class="container">
        <div class="copyright text-center">Copyright © 2017-2018 北京才穗获客广告有限公司
            <a href="http://www.miitbeian.gov.cn/">京ICP备18012622号-1</a>
        </div>
    </div>
</div>
<!-- Modal -->
<input type="hidden" name="service_province">
<input type="hidden" name="service_city">
<input type="hidden" name="service_district">
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
                <form class="form-horizontal" role="form" data-toggle="validator" id="form02">
                    <div class="form-group">
                        <label for="" class="col-xs-3 control-label">服务区域：</label>
                        <div class="col-xs-9">
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
                        <label for="" class="col-xs-3 control-label">联系方式：</label>
                        <div class="col-xs-9">
                            <div class="has-placeholder-label">
                                <input type="tel" name="mobile" class="form-control" id="" placeholder="" required pattern="^1(3|4|5|7|8)[0-9]\d{8}$" maxlength="11">
                                <label for="" class="placeholder-label">请留下您的手机号码
                                        <em>（必填项*）</em>
                                    </label>
                            </div>
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
                        <div class="col-sm-12">
                            <button onclick="_hmt.push(['_trackEvent', (location.href.indexOf('/')>-1?'我要服务':'立即核名'), '点击', '提交'])" type="submit" class="btn btn-default btn-block submit">我要服务</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade alert-modal" id="Modal02" tabindex="-1" role="dialog" aria-labelledby="Modal02Label">
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
                        专业财税顾问会在第一时间与您联系。</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-blue" data-dismiss="modal">好的</a>
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
                    <img src="{{ asset('mobile/images/icon32.png') }}" class="alert-icon">
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
<!-- script -->
<script src="{{ asset('web/js/lib/jquery.min.js') }}"></script>
<script src="http://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('web/js/lib/jquery.SuperSlide.2.1.1.js') }}"></script>
<script src="{{ asset('web/js/lib/jquery.citys.js') }}"></script>
<script src="{{ asset('web/js/lib/validator.min.js') }}"></script>
<script src="{{ asset('web/js/app.js') }}"></script>
<!-- <script>
    (function(a,h,c,b,f,g){a["UdeskApiObject"]=f;a[f]=a[f]||function(){(a[f].d=a[f].d||[]).push(arguments)};g=h.createElement(c);g.async=1;g.charset="utf-8";g.src=b;c=h.getElementsByTagName(c)[0];c.parentNode.insertBefore(g,c)})(window,document,"script","http://assets-cli.udesk.cn/im_client/js/udeskApi.js","ud");
    ud({
        "code": "1dd90ai0",
        "link": "http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163"
    });
</script> -->
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