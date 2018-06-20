@extends('wap.layouts.base')

@section('dk')
<meta name="description" content="万众企服是一家致力于中小企业工商代办,公司注册,代理记账,代办营业执照等服务的一站式智能企业服务平台.服务范围覆盖全国,服务企业用户超过60万家,服务项目包括工商代办,公司注册,代理记账,代办营业执照,商标注册等。" />
<meta name="keywords" content="工商代办,公司注册,代理记账,代办营业执照,万众企服" />
@endsection


@section('sub_title')
    <img src="{{ asset('mobile/images/logo.png') }}" class="logo">
@endsection

@section('content')
    <div id="indexBanner" class="index-banner">
        @foreach($slides as $slide)
            <div class="banner-item">
                <a onclick="_hmt.push(['_trackEvent', '手机banner大图', '点击', '{{ $slide->url }}'])"  href="{{ $slide->url }}" style="background-image: url({{ asset($slide->wap_img)}});"> </a>
            </div>
        @endforeach
    </div>
    <div class="index-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/yxgszc') }}">
                        <img src="{{ asset('mobile/images/icon01.png') }}"> 公司注册 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/nzdljz') }}">
                        <img src="{{ asset('mobile/images/icon02.png') }}"> 代理记账 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/sbzc') }}">
                        <img src="{{ asset('mobile/images/icon03.png') }}"> 商标注册 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="" data-toggle="modal" data-target="#Modal01">
                        <img src="{{ asset('mobile/images/icon04.png') }}"> 企业核名 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/hegs') }}">
                        <img src="{{ asset('mobile/images/icon05.png') }}"> 税收优惠 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/zcdz') }}">
                        <img src="{{ asset('mobile/images/icon06.png') }}"> 注册地址 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('wap/services') }}">
                        <img src="{{ asset('mobile/images/icon07.png') }}"> 服务商入驻 </a>
                </div>
                <div class="col-xs-3">
                    <a class="menu-item" href="{{ url('/wap/category') }}">
                        <img src="{{ asset('mobile/images/icon08.png') }}"> 全部分类 </a>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ url('wap/nzdljz') }}"><img src="{{ asset('mobile/pic/banner02.png') }}" alt="" class="img-responsive"></a>
    <div class="index-hot">
        <h3>
            <i class="icon icon09"></i>热门推荐</h3>
        <div class="hot-items">
            @foreach($recommends as $item)
            <a onclick="_hmt.push(['_trackEvent', '手机热门推荐', '点击', '{{ $item->url }}'])"  href="{{ $item->url }}" class="hot-item">
                <div class="hot-img">
                    <img src="{{ asset($item->bg_img) }}"> </div>
                <div class="hot-intro">
                    <h4>{{ $item->name }}</h4>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    <div class="index-advantage">
        <h3>
            <i class="icon icon10"></i>我们的优势</h3>
        <img src="{{ asset('mobile/pic/banner03.png') }}" alt="" class="advantage-bg"> </div>
@endsection