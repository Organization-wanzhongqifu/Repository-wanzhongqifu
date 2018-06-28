@extends('web.layouts.base')

@section('dk')
<meta name="description" content="万众企服是一家致力于中小企业工商代办,公司注册,代理记账,代办营业执照等服务的一站式智能企业服务平台.服务范围覆盖全国,服务企业用户超过60万家,服务项目包括工商代办,公司注册,代理记账,代办营业执照,商标注册等。" />
<meta name="keywords" content="工商代办,公司注册,代理记账,代办营业执照,万众企服" />
@endsection

@section('css')
    <style>
        .suceess-item .pc-flex-wrap{ width: 1200px;margin: 0 auto; text-align: center; display: flex;justify-content: space-around;margin-bottom: 30px;}
        .suceess-item .pc-flex-wrap .pc-flex-per{width: 230px;height: 110px;background: #f5f5f7 url('../../pc1/img/1.png') center center no-repeat;}
    </style>
@endsection
@section('js')
    <script>
        // 企业核名请求提交
        $('.submit').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                var approval = {};
                approval.city = $('input[name=company_city]').val();
                approval.company_name = $('input[name=company_name]').val();
                approval.service_province = $('input[name=service_province]').val();
                approval.service_city = $('input[name=service_city]').val();
                approval.service_district = $('input[name=service_district]').val();
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
                });
            }
        });
    </script>
@endsection

@section('indexBanner')
    <div id="indexBanner" class="index-banner">
        <div class="hd">
            <ul>
                @for($i = 1; $i <= count($slides); $i++)
                <li>$i</li>
                @endfor
            </ul>
        </div>
        <div class="bd">
            <ul>
                @foreach($slides as $slide)
                <li>
                    <a onclick="_hmt.push(['_trackEvent', 'banner大图', '点击', '{{ $slide->url }}'])" href="{{ $slide->url }}" style="background-image: url({{ asset($slide->pc_img)}});"></a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="index-content">
        <div class="container">
            <div class="index-query">
                <h3>自助核准公司名称</h3>
                <form class="form-inline" role="form" data-toggle="validator" id="form01">
                    <div class="form-group hot-city">
                        <input type="text" name="company_city" class="form-control" placeholder="请输入公司所在城市，如：北京" value="@if($city && $city != 'A'){{ $city }}@endif" required> 
                        <a class="select-btn"><i class="icon-down"></i></a>
                        <div class="dropdown-box">
                            <a href="">北京</a>
                            <a href="">上海</a>
                            <a href="">广州</a>
                            <a href="">深圳</a>
                            <a href="">南京</a>
                            <a href="">成都</a>
                            <a href="">杭州</a>
                            <a href="">苏州</a>
                            <a href="">东莞</a>
                            <a href="">厦门</a>
                            <a href="">福州</a>
                            <a href="">青岛</a>
                            <a href="">宁波</a>
                            <a href="">珠海</a>
                            <a href="">嘉兴</a>
                            <a href="">佛山</a>
                            <a href="">中山</a>
                            <a href="">无锡</a>
                            <a href="">郑州</a>
                            <a href="">洛阳</a>
                            <a href="">哈尔滨</a>
                            <a href="">济南</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="company_name" class="form-control" placeholder="请输入公司名称" required>
                    </div>
                    <button onclick="_hmt.push(['_trackEvent', '免费查询', '点击', '弹窗'])" type="submit" class="btn btn-primary">免费查询</button>
                </form>
            </div>
            <div class="index-hot">
                <h3>
                    <i class="icon icon05"></i>热门推荐</h3>
                <div class="hot-slide">
                    <div class="hd">
                        <a class="next"></a>
                        <a class="prev"></a>
                    </div>
                    <div class="bd">
                        <ul>
                            @foreach($recommends as $recommend)
                            <li>
                                <a onclick="_hmt.push(['_trackEvent', '热门推荐', '点击', '{{ $recommend->url }}'])" class="hot-item" href="{{ $recommend->url }}" style="background-image: url({{ asset($recommend->bg_img)}});">
                                    <h4>{{ $recommend->name }}</h4>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="index-advantage">
                <h3>
                    <i class="icon icon06"></i>我们的优势</h3>
                <img src="{{ asset('web/pic/advantage01.png')}}" alt="" class="advantage-bg"> </div>
        </div>
    </div>
    <!-- <div class="index-bg01" style="background-image:url({{ asset('web/pic/bg01.png')}});"> </div> -->
    
    <div class="suceess-item">
        <h3 style="font-size: 30px;color:#3b5999;height: 40px;line-height: 40px;text-align: center;">他们都选择的了万众企服</h3>
        <div style="margin-bottom: 10px;text-align: center;">
            <img src="../../web/pic/heng.png" alt="">
        </div>
        <div class="pc-flex-wrap">
            <div class="pc-flex-per"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/2.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/3.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/4.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/5.png')"></div>
        </div>
        <div class="pc-flex-wrap">
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/6.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/7.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/8.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/9.png');background-position: 15px -45px"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/10.png')"></div>
        </div>
        <div class="pc-flex-wrap">
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/11.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/12.png');background-position: 29px 8px;"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/13.png')"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/14.png');background-position: 14px 8px;"></div>
            <div class="pc-flex-per" style="background-image: url('../../pc1/img/15.png')"></div>
        </div>
    </div>

    <div class="feature-box">
        <div class="container">
            <div class="feature-item">
                <i class="icon icon07"></i>
                <h4>极速响应</h4>
                <p>第一时间响应您的需求</p>
            </div>
            <div class="feature-item">
                <i class="icon icon08"></i>
                <h4>专属服务</h4>
                <p>服务顾问全程1对1服务</p>
            </div>
            <div class="feature-item">
                <i class="icon icon09"></i>
                <h4>覆盖全国</h4>
                <p>服务已遍布全国200+城市</p>
            </div>
            <div class="feature-item">
                <i class="icon icon10"></i>
                <h4>信息安全</h4>
                <p>保障客户信息安全</p>
            </div>
            <div class="feature-item">
                <i class="icon icon11"></i>
                <h4>高效运作</h4>
                <p>高效管理制度，轻松管理公司</p>
            </div>
            <div class="feature-item">
                <i class="icon icon12"></i>
                <h4>售后保障</h4>
                <p>服务问题及时解决</p>
            </div>
        </div>
    </div>
@endsection