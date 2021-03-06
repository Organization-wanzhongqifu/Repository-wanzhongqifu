{{ csrf_field() }}

<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
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

<div class="form-group @if($errors->has('pc_img')) has-error @endif">
    <label for="" class="col-md-3 control-label">PC端图片：</label>
    <div class="col-md-5">
        <em class="btn bg-gray btn-sm fc-upload-btn"><input id="pc_img" data-width="0" data-height="0" class="file-upload" name="pc_img_upload" type="file" multiple="false" accept="image/jpeg,image/jpg,image/png">上传图片</em>
        <a class="pc_img @if($form_type == 'create') img-hide @endif" href="{{ $form_type == 'create' ? asset(old('pc_img')) : asset($row->pc_img) }}" data-lightbox="pc_img"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
        <input type="hidden" name="pc_img" value="{{ $form_type == 'create' ? old('pc_img') : $row->pc_img }}">
        @if($errors->has('pc_img'))
            <span class="help-block">{{ $errors->first('pc_img') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议图片尺寸为：1905 * 440</div>
</div>

<div class="form-group @if($errors->has('wap_img')) has-error @endif">
    <label for="" class="col-md-3 control-label">移动端图片：</label>
    <div class="col-md-5">
        <em class="btn bg-gray btn-sm fc-upload-btn"><input id="wap_img" data-width="0" data-height="0" class="file-upload" name="wap_img_upload" type="file" multiple="false" accept="image/jpeg,image/jpg,image/png">上传图片</em>
        <a class="wap_img @if($form_type == 'create') img-hide @endif" href="{{ $form_type == 'create' ? asset(old('wap_img')) : asset($row->wap_img) }}" data-lightbox="wap_img"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
        <input type="hidden" name="wap_img" value="{{ $form_type == 'create' ? old('wap_img') : $row->wap_img }}">
        @if($errors->has('wap_img'))
            <span class="help-block">{{ $errors->first('wap_img') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议图片高度为：180</div>
</div>