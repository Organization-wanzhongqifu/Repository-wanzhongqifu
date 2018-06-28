@extends('wap.layouts.base')

@section('sub_title')
    <img src="{{ asset('mobile/images/logo.png') }}" class="logo">
@endsection

@section('content')
    <div class="category-warp">
        <div class="category-content">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($categories as $key => $category)
                <li role="presentation" @if($key == 0) class="active" @endif>
                    <a href="#tab0{{ $key + 1 }}" aria-controls="tab0{{ $key + 1 }}" role="tab" data-toggle="tab">{{ $category->name }}</a>
                </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach($categories as $key => $category)
                <div role="tabpanel" class="tab-pane @if($key == 0) active @endif" id="tab0{{ $key + 1 }}">
                    <h4>{{ $category->name }}</h4>
                    <ul>
                        @foreach($category->sub as $item)
                        <li>
                            <a href="{{ url('/wap/services/' . $item->id) }}">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection