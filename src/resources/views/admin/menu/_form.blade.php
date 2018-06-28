{{ csrf_field() }}

<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议名称不超过4个字</div>
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