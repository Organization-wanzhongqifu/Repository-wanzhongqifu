{{ csrf_field() }}

<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">联系名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('mobile')) has-error @endif">
    <label for="mobile" class="col-md-3 control-label">联系方式：</label>
    <div class="col-md-5">
        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $form_type == 'create' ? old('mobile') : $row->mobile }}">
        @if($errors->has('mobile'))
            <span class="help-block">{{ $errors->first('mobile') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('company_name')) has-error @endif">
    <label for="company_name" class="col-md-3 control-label">公司名称：</label>
    <div class="col-md-5">
        <input type="text" name="company_name" id="company_name" class="form-control" value="{{ $form_type == 'create' ? old('company_name') : $row->company_name }}">
        @if($errors->has('company_name'))
            <span class="help-block">{{ $errors->first('company_name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('address_city')) has-error @endif">
    <label for="address_city" class="col-md-3 control-label">服务区域：</label>
    <div class="col-md-5">
        <div data-toggle="distpicker">
            <select name="address_province" data-province="{{ $form_type == 'create' ? old('address_province') ? old('address_province') : ' 选择省 ' : $row->address_province }}"></select>
            <select name="address_city" data-city="{{ $form_type == 'create' ? old('address_city') ? old('address_city') : ' 选择市 ' : $row->address_city }}"></select>
            <select name="address_district" data-district="{{ $form_type == 'create' ? old('address_district') ? old('address_district') : ' 选择区 ' : $row->address_district }}"></select>
        </div>
        @if($errors->has('address_city'))
            <span class="help-block">{{ $errors->first('address_city') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>