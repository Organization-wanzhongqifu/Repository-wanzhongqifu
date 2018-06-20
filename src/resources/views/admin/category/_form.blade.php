{{ csrf_field() }}

@section('js')
    <script>
        $(function () {
             $('.sort').on('blur', function () {
                 var id = $(this).data('id');
                 var value = $(this).val();
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type: 'POST',
                     url: '/adminApi/services/field',
                     data: {id: id, key: 'sort', value: value}
                 }).done(function (data) {
                     // do nothing
                 });
             });

            $('.highlight').on('change', function () {
                var id = $(this).data('id');
                var value = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/adminApi/services/field',
                    data: {id: id, key: 'highlight', value: value}
                }).done(function (data) {
                    // do nothing
                });
            });
        });
    </script>
@endsection

<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议名称不超过5个字</div>
</div>

<div class="form-group @if($errors->has('icon')) has-error @endif">
    <label for="" class="col-md-3 control-label">Icon：</label>
    <div class="col-md-5">
        <em class="btn bg-gray btn-sm fc-upload-btn"><input id="icon" data-width="0" data-height="0" class="file-upload" name="icon_upload" type="file" multiple="false" accept="image/jpeg,image/jpg,image/png">上传图片</em>
        <a class="icon @if($form_type == 'create') img-hide @endif" href="{{ $form_type == 'create' ? asset(old('icon')) : asset($row->icon) }}" data-lightbox="icon"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
        <input type="hidden" name="icon" value="{{ $form_type == 'create' ? old('icon') : $row->icon }}">
        @if($errors->has('icon'))
            <span class="help-block">{{ $errors->first('icon') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

@if($form_type != 'create')
    <div class="form-group">
        <label for="name" class="col-md-3 control-label">服务项：</label>
        <div class="col-md-5">
            <table class="table table-striped">
                <tr>
                    <th>服务名称</th>
                    <th>排序</th>
                    <th>是否高亮</th>
                </tr>
                @foreach($services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td><input type="text" data-id="{{ $service->id }}" class="form-control sort" value="{{ $service->sort }}"></td>
                    <td>
                        <select class="form-control highlight" data-id="{{ $service->id }}" name="highlight">
                            <option @if($service->highlight == 1) selected @endif value="1">是</option>
                            <option @if($service->highlight == 0) selected @endif value="0">否</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endif