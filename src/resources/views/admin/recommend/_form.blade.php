{{ csrf_field() }}

<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议不超过12个字</div>
</div>

<div class="form-group @if($errors->has('url')) has-error @endif">
    <label for="url" class="col-md-3 control-label">URL：</label>
    <div class="col-md-5">
        <input type="text" name="url" id="url" class="form-control" value="{{ $form_type == 'create' ? old('url') : $row->url }}">
        @if($errors->has('url'))
            <span class="help-block">{{ $errors->first('url') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('bg_img')) has-error @endif">
    <label for="" class="col-md-3 control-label">背景图：</label>
    <div class="col-md-5">
        <em class="btn bg-gray btn-sm fc-upload-btn"><input id="bg_img" data-width="0" data-height="0" class="file-upload" name="bg_img_upload" type="file" multiple="false" accept="image/jpeg,image/jpg,image/png">上传图片</em>
        <a class="bg_img @if($form_type == 'create') img-hide @endif" href="{{ $form_type == 'create' ? asset(old('bg_img')) : asset($row->bg_img) }}" data-lightbox="bg_img"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
        <input type="hidden" name="bg_img" value="{{ $form_type == 'create' ? old('bg_img') : $row->bg_img }}">
        @if($errors->has('bg_img'))
            <span class="help-block">{{ $errors->first('bg_img') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}">建议图片尺寸为：363 * 400</div>
</div>