{{ csrf_field() }}

<input type="password" style="display: none">

<div class="form-group @if(session('errors.name')) has-error @endif">
    <label for="name" class="col-md-3 control-label">账号</label>
    <div class="col-md-5">
        <input type="text" name="name" {{ $form_type == 'create' ? '' : ' readonly="readonly" ' }} id="name" autocomplete="off" class="form-control" value="{{ $form_type == 'create' ? old('name') : $user -> name }}" placeholder="请输入用户名">
        @if(session('errors.name'))
            <span class="help-block">{{ session('errors.name') }}</span>
        @endif
    </div>
</div>
<div class="form-group @if(session('errors.password')) has-error @endif">
    <label for="password" class="col-md-3 control-label">密码</label>
    <div class="col-md-5">
        <input type="password" name="password" id="password" class="form-control" autocomplete="new-password" value="" placeholder="请输入密码">
        @if(session('errors.password'))
            <span class="help-block">{{ session('errors.password') }}</span>
        @endif
    </div>
</div>
<div class="form-group">
    <label for="role" class="col-md-3 control-label">所属角色</label>
    <div class="col-md-5">
        <div>
            @if(count($role_list))
                <select name="role_ids[]" id="role_ids">
                @foreach($role_list as $k => $item)
                    <option value="{{$item->id}}" @if($form_type!='create' && in_array($item->id, $user_role_ids)) selected @endif>{{$item->name}}</option>
                @endforeach
                </select>
            @endif
        </div>
    </div>
</div>