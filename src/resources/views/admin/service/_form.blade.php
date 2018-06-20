{{ csrf_field() }}

@section('js')
    <script src="{{ asset('static/ueditor/ueditor.config.js') }}"></script>
    <script src="{{ asset('static/ueditor/ueditor.all.js') }}"></script>
    <script>
        $(function () {
            var service_id = $('#service_id').val();
            var specification = '<tr>\n' +
                '                <td>\n' +
                '                    <input type="text" name="sname[]" class="name" value=""> <img class="must" src="{{ asset('img/must.png') }}"> 建议不超过10个字\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <input type="text" name="sprice[]" class="price" value="">\n' +
                '                </td>\n' +
                '                <td>\n' +
                '                    <a class="confirm" href="javascript:;">确认</a> <a class="delete" href="javascript:;">删除</a>\n' +
                '                </td>\n' +
                '            </tr>';
            $('.specification').on('click', function () {
                var length = $('.name').length;
                if (parseInt(length) === 12) {
                    layer.msg('服务项最多只能增加12个');
                } else {
                    $(this).parent().parent().before(specification);
                }
            });

            // 规格添加
            $('body').on('click', '.confirm', function () {
                var name = $(this).parent().siblings().find('.name').val();
                var price = $(this).parent().siblings().find('.price').val();
                var that = this;
                if (!name || !price) {
                    console.log(name);
                    console.log(price);
                    layer.msg('名称和价格不能为空');
                } else {
                    if (service_id) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                            }
                        });
                        var id = $(this).data('id');
                        if (id) {
                            $.ajax({
                                type: 'POST',
                                url: '/adminApi/specifications/' + id,
                                data: {name: name, price: price}
                            }).done(function (data) {
                                layer.msg('更新成功', {icon: 1});
                            });
                        } else {
                            $.ajax({
                                type: 'POST',
                                url: '/adminApi/specifications',
                                data: {name: name, price: price, service_id: service_id},
                                dataType: "json"
                            }).done(function (data) {
                                $(that).attr('data-id', data.id);
                                $(that).siblings('.delete').attr('data-id', data.id);
                                layer.msg('新增成功', {icon: 1});
                            });
                        }
                    } else {
                        layer.msg('新增成功', {icon: 1});
                    }
                }
            });
            // 规格删除
            $('body').on('click', '.delete', function () {
                if (confirm('确认删除?')) {
                    if ($(this).data('id') && service_id) {
                        var id = $(this).data('id');
                        console.log(id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: 'POST',
                            url: '/adminApi/specifications/' + id + '/delete',
                        }).done(function (data) {
                            layer.msg('删除成功', {icon: 1});
                        });
                    }
                    $(this).parent().parent().remove();
                }
            });

            UE.getEditor('pc_text', {
                autoFloatEnabled: false,
                zIndex: 0,
                toolbars: [
                    ['undo', 'redo', '|', 'paragraph', '|', 'bold', 'italic', 'underline', 'forecolor', 'insertorderedlist', 'insertunorderedlist', 'insertimage', 'link', 'fullscreen']
                ],
                autoHeight: true,
                initialFrameHeight: 320
            });
            UE.getEditor('wap_text', {
                autoFloatEnabled: false,
                zIndex: 0,
                toolbars: [
                    ['undo', 'redo', '|', 'paragraph', '|', 'bold', 'italic', 'underline', 'forecolor', 'insertorderedlist', 'insertunorderedlist', 'insertimage', 'link', 'fullscreen']
                ],
                autoHeight: true,
                initialFrameHeight: 320
            });
        });
    </script>
@endsection
@if ($form_type != 'create')
<input type="hidden" name="service_id" id="service_id" value="{{ $row->id }}">
@endif
<div class="form-group @if($errors->has('name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">服务名称：</label>
    <div class="col-md-5">
        <input type="text" name="name" id="name" class="form-control" value="{{ $form_type == 'create' ? old('name') : $row->name }}">
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 建议不超过12个字</div>
</div>

<div class="form-group @if($errors->has('route')) has-error @endif">
    <label for="route" class="col-md-3 control-label">命名URL：</label>
    <div class="col-md-5">
        <input type="text" name="route" id="route" class="form-control" value="{{ $form_type == 'create' ? old('route') : $row->route }}">
        @if($errors->has('route'))
            <span class="help-block">{{ $errors->first('route') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"> 请填写http://qifu1818.com/xxxx中“xxxx”</div>
</div>

<div class="form-group @if($errors->has('category_id')) has-error @endif">
    <label for="category_id" class="col-md-3 control-label">服务类型：</label>
    <div class="col-md-5">
        <select name="category_id" id="category_id" class="form-control">
            @foreach($categories as $category)
            <option @if($form_type == 'edit' && $row->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @if($errors->has('category_id'))
            <span class="help-block">{{ $errors->first('category_id') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('thumb')) has-error @endif">
    <label for="" class="col-md-3 control-label">图片：</label>
    <div class="col-md-5">
        <em class="btn bg-gray btn-sm fc-upload-btn"><input id="thumb" data-width="0" data-height="0" class="file-upload" name="thumb_upload" type="file" multiple="false" accept="image/jpeg,image/jpg,image/png">上传图片</em>
        <a class="thumb @if($form_type == 'create') img-hide @endif" href="{{ $form_type == 'create' ? asset(old('thumb')) : asset($row->thumb) }}" data-lightbox="thumb"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
        <input type="hidden" name="thumb" value="{{ $form_type == 'create' ? old('thumb') : $row->thumb }}">
        @if($errors->has('thumb'))
            <span class="help-block">{{ $errors->first('thumb') }}</span>
        @endif
    </div>
    <div class="col-md-4 text-dark-gray input-vertical-center"><img class="must" src="{{ asset('img/must.png') }}"></div>
</div>

<div class="form-group @if($errors->has('sname')) has-error @endif">
    <label for="name" class="col-md-3 control-label">服务项：</label>
    <div class="col-md-9">
        <table class="table table-striped">
            <tr>
                <th width="50%">规格名称</th>
                <th width="30%">商品价格</th>
                <th width="20%">操作</th>
            </tr>
            @if (isset($specifications))
                @foreach($specifications as $specification)
                    <tr>
                        <td><input type="text" name="sname[]" class="name" value="{{ $specification->name }}"></td>
                        <td><input type="text" name="sprice[]" class="price" value="{{ $specification->price }}"></td>
                        <td><a data-id="{{ $specification->id }}" class="confirm" href="javascript:;">确认</a> <a data-id="{{ $specification->id }}" class="delete" href="javascript:;">删除</a></td>
                    </tr>
                @endforeach
            @endif
            <tr>
                <td colspan="3"><a href="javascript:;" class="btn btn-default specification">添加规格项目</a></td>
            </tr>
        </table>
        @if($errors->has('sname'))
            <span class="help-block">{{ $errors->first('sname') }}</span>
        @endif
    </div>
</div>

<div class="form-group @if($errors->has('pc_text')) has-error @endif">
    <label for="pc_text" class="col-md-3 control-label">PC端图片：<br><img class="must" src="{{ asset('img/must.png') }}"> 建议图片宽度1170px</label>
    <div class="col-md-9">
        <textarea name="pc_text" id="pc_text" cols="30" rows="10" style="width: 100%;">{{ $form_type == 'create' ? old('pc_text') : $row->pc_text }}</textarea>
        @if($errors->has('pc_text'))
            <span class="help-block">{{ $errors->first('pc_text') }}</span>
        @endif
    </div>
</div>

<div class="form-group @if($errors->has('wap_text')) has-error @endif">
    <label for="wap_text" class="col-md-3 control-label">WAP端图片：</label>
    <div class="col-md-9">
        <textarea name="wap_text" id="wap_text" cols="30" rows="10" style="width: 100%;">{{ $form_type == 'create' ? old('wap_text') : $row->wap_text }}</textarea>
        @if($errors->has('wap_text'))
            <span class="help-block">{{ $errors->first('wap_text') }}</span>
        @endif
    </div>
</div>