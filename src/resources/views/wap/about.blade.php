@extends('wap.layouts.base')

@section('dk')
<meta name="description" content="万众企服是一家致力于中小企业工商代办,公司注册,代理记账,代办营业执照等服务的一站式智能企业服务平台.服务范围覆盖全国,服务企业用户超过60万家,服务项目包括工商代办,公司注册,代理记账,代办营业执照,商标注册等。" />
<meta name="keywords" content="关于我们" />
@endsection

@section('title')@parent关于我们-万众企服@stop

@section('sub_title')
    <span class="title">关于我们</span>
@endsection

@section('content')
    <img src="{{ asset('mobile/pic/banner04.png') }}" class="img-responsive">
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">走进万众企服</h3>
            <div class="about-intro">
                <p>万众企服隶属于北京才穗获客广告有限公司，是云帐房旗下全资设立的子公司，是一站式创业服务互联网平台，为中小企业提供包括代理记账、工商注册、工商变更、税务代办、财税咨询、商标注册等专业高效的一体化财税服务。</p>
                <p>目前服务范围包含北京、上海、广州、深圳、江苏、浙江、四川、山东、黑龙江、福建等十多个城市，平台拥有超过1800家专业财税服务团队，每月为全国超过60万中小微企业提供记账报税服务，为过百万创业者提供公司注册、税务代办等一体化财税服务。</p>
                <p>万众企服依托“智能财税”，以标准化、智能化、规模化为目标，凭借模式创新、技术驱动、以用户为中心等核心优势，在提升行业效率、解决用户痛点的方向持续努力，致力于为中小企业提供更专业、更深度的智能财税服务。</p>
            </div>
        </div>
    </div>
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">万众企服的优势</h3>
            <div class="about-advantage text-center">
                <div class="row">
                    <div class="col-xs-4">
                        <i class="icon icon16"></i>
                        <h4>有品牌</h4>
                        <p>全国统一平台
                            <br> 著名投资公司投资</p>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon icon17"></i>
                        <h4>有实力</h4>
                        <p>服务范围覆盖
                            <br> 全国多个城市</p>
                    </div>
                    <div class="col-xs-4">
                        <i class="icon icon18"></i>
                        <h4>有保障</h4>
                        <p> 结果可查询
                            <br> 平台可维权</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('mobile/pic/banner03.png') }}" class="img-responsive">
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">联系我们</h3>
            <a href="" target="_blank">
                <img src="{{ asset('mobile/images/map.png') }}" alt="" class="map"> </a>
            <address>总部地址：北京市东城区银河SOHO D座11层51110室</address>
            <div class="row">
                <div class="col-xs-6">
                    <div class="add-item">
                        <h4 class="title01">总公司网址</h4>
                        <p>
                            <a href="http://www.qifu1818.com">http://www.qifu1818.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="add-item">
                        <h4 class="title02">商务合作</h4>
                        <p>
                            <a href="mailto:BD@qifu1818.com">BD@qifu1818.com</a>
                        </p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="add-item">
                        <h4 class="title03">咨询电话</h4>
                        <p>
                            <a href="tel:4000391818">400-039-1818</a>
                        </p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="add-item">
                        <h4 class="title04">公司邮箱</h4>
                        <p>
                            <a href="mailto:BD@qifu1818.com">BD@qifu1818.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">融资背景</h3>
        </div>
        <img src="{{ asset('mobile/pic/banner05.png') }}" class="img-responsive"> </div>
@endsection