<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Controllers\AdminApi\BaseController;
use App\Http\Requests\Admin\AdminUser\AdminUserCreateRequest;
use App\Http\Requests\Admin\AdminUser\AdminUserEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class AdminUserController extends BaseController
{
    /**
     * 管理员列表数据
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $rows = DB::table('admin_users')
            ->leftJoin('admin_role_user', 'admin_role_user.user_id', '=', 'admin_users.id')
            ->leftJoin('admin_roles', 'admin_roles.id', '=', 'admin_role_user.role_id')
            ->select('admin_users.id', 'admin_users.name', DB::raw('hm_admin_roles.name as role'))
            ->where('admin_users.id', '!=', 1)
            ->where('admin_users.is_delete', 0)->orderBy('admin_users.created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                $buttons = ' <a href="'. route('admin.adminUser.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" onclick="delData('. $row->id .')" class="btn btn-xs btn-primary"> 删除</a>';
                return $buttons;
            })
            ->make(true);
    }

    /**
     * 创建管理员
     * @param AdminUserCreateRequest $request
     * @return mixed
     */
    public function store(AdminUserCreateRequest $request)
    {
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建管理员
        $result = $this->adminUserService->createAdmin($form_data);

        //返回响应
        return $this->tool->response($result, 'admin/adminUser');
    }

    /**
     * 编辑管理员
     * @param $id
     * @param AdminUserEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AdminUserEditRequest $request)
    {
        $id = (int)$id;
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //编辑管理员
        $result = $this->adminUserService->editAdmin($id, $form_data);

        //返回响应
        return $this->tool->response($result, 'admin/adminUser');
    }

    /**
     * 删除管理员
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $id = (int)$id;

        //删除管理员
        $result = $this->adminUserService->deleteAdmin($id);

        //返回响应
        return $this->tool->setType('json')->response($result);
    }

}
