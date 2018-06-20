{{ csrf_field() }}

@section('js')
    <script>
        $('#service_id').on('change', function () {
            var service_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/adminApi/services/' + service_id + '/specifications',
                dataType: "json"
            }).done(function (data) {
                var html = '';
                $.each(data, function (name, value) {
                    html += '<option value="'+value.id+'">'+value.name+'</option>';
                });

                $('#specification_id').append(html);
            });
        });
    </script>
@endsection

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

<div class="form-group @if($errors->has('service_city')) has-error @endif">
    <label for="service_city" class="col-md-3 control-label">服务区域：</label>
    <div class="col-md-5">
        <div data-toggle="distpicker">
            <select name="service_province" data-province="{{ $form_type == 'create' ? old('service_province') ? old('service_province') : ' 选择省 ' : $row->service_province }}"></select>
            <select name="service_city" data-city="{{ $form_type == 'create' ? old('service_city') ? old('service_city') : ' 选择市 ' : $row->service_city }}"></select>
            <select name="service_district" data-district="{{ $form_type == 'create' ? old('service_district') ? old('service_district') : ' 选择区 ' : $row->service_district }}"></select>
        </div>
        @if($errors->has('service_city'))
            <span class="help-block">{{ $errors->first('service_city') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('service_id')) has-error @endif">
    <label for="service_id" class="col-md-3 control-label">选择服务：</label>
    <div class="col-md-5">
        <select name="service_id" id="service_id" class="form-control">
            <option value="">请选择服务</option>
            @foreach($services as $service)
            <option @if($form_type == 'edit' && $row->service_id == $service->id) selected @endif value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
        @if($errors->has('service_id'))
            <span class="help-block">{{ $errors->first('service_id') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('specification_id')) has-error @endif">
    <label for="specification_id" class="col-md-3 control-label">选择规格：</label>
    <div class="col-md-5">
        <select name="specification_id" id="specification_id" class="form-control">
            <option value="">请选择规格</option>
            @if($form_type == 'edit')
                @foreach($specifications as $specification)
                    <option @if($row->specification_id == $specification->id) selected @endif value="{{ $specification->id }}">{{ $specification->name }}</option>
                @endforeach
            @endif
        </select>
        @if($errors->has('specification_id'))
            <span class="help-block">{{ $errors->first('specification_id') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>





