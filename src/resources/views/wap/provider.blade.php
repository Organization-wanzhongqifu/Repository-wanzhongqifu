@extends('wap.layouts.base')

@section('dk')
<meta name="description" content="万众企服是一家致力于中小企业工商代办,公司注册,代理记账,代办营业执照等服务的一站式智能企业服务平台.服务范围覆盖全国,服务企业用户超过60万家,服务项目包括工商代办,公司注册,代理记账,代办营业执照,商标注册等。" />
<meta name="keywords" content="立即入驻,入驻万众企服" />
@endsection

@section('title')@parent欢迎入驻万众企服！@stop


@section('css')
    <style>
        .footer.base {
            display: none;
        }
    </style>
@endsection

@section('sub_title')
    <span class="title">服务商入驻</span>
@endsection

@section('content')
    <img src="{{ asset('mobile/pic/banner06.png') }}" class="img-responsive">
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">合作流程</h3>
            <img src="{{ asset('mobile/pic/pic06.png') }}" class="img-responsive">
        </div>
    </div>
    <div class="cell">
        <div class="container">
            <h3 class="cell-title">平台优势</h3>
            <img src="{{ asset('mobile/pic/pic07.png') }}" class="img-responsive">
        </div>
    </div>
    <div class="footer">
        <div class="footer-contact">
            <a href="" onclick="_hmt.push(['_trackEvent', '手机立即入驻', '点击', '弹窗'])"  class="btn-buy" data-toggle="modal" data-target="#Modal02" data-backdrop="static">立即入驻</a>
            <a onclick="_hmt.push(['_trackEvent', '手机立即咨询', '点击', '跳转'])" href="http://p.qiao.baidu.com/cps/chat?siteId=11911985&userId=25456163" rel="nofollow" class="btn-contact">立即咨询</a>
        </div>
    </div>
@endsection