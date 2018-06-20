<?php

namespace App\Http\Controllers\AdminApi;

use App\Helpers\CommonHelper;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class AdminController extends BaseController
{

    public function reset(Request $request)
    {$this->validate($request, [
        'password' => 'required|confirmed',
    ], [
        'password.required' => '请输入新密码',
        'password.confirmed' => '两次密码不一致'
    ]);
        $id = auth('admin')->id();
        $password = bcrypt($request->get('password'));
        DB::table('admin_users')->where('id', $id)->update(['password' => $password]);
        return redirect('admin/admin/reset')->with('prompt', ['status' => 1, 'msg' => '修改密码成功']);
    }
}
