<?php

namespace App\Http\Controllers\AdminApi;

use App\Http\Requests\Admin\AdminRole\AdminRoleCreateRequest;
use App\Http\Requests\Admin\AdminRole\AdminRoleEditRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class AdminRoleController extends BaseController
{
    /**
     * 角色列表数据
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $rows = DB::table('admin_roles')->select('id', 'name', DB::raw("(select count(1) count from hm_admin_role_user where role_id = hm_admin_roles.id) as count"))->orderBy('admin_roles.created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                $buttons = ' <a href="'. route('admin.adminRole.auth', [$row->id]) .'" class="btn btn-xs btn-primary"> 授权</a>';
                $buttons .= ' <a href="'. route('admin.adminRole.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" onclick="delData('. $row->id .')" class="btn btn-xs btn-primary"> 删除</a>';
                return $buttons;
            })
            ->make(true);
    }

    /**
     * 添加角色
     * @param AdminRoleCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRoleCreateRequest $request)
    {
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //创建角色
        $result = $this->adminRoleService->createRole($form_data);

        //返回响应
        return $this->tool->response($result, 'admin/adminRole');
    }

    /**
     * 编辑角色
     * @param $id
     * @param AdminRoleEditRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, AdminRoleEditRequest $request)
    {
        $id = (int)$id;
        //获取数据
        $form_data = $request->except(['_token', '_method']);

        //编辑角色
        $result = $this->adminRoleService->editRole($id, $form_data);

        //返回响应
        return $this->tool->response($result, 'admin/adminRole');
    }

    /**
     * 删除角色
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $id = (int)$id;
        //删除角色
        $result = $this->adminRoleService->deleteRole($id);

        //返回响应
        return $this->tool->setType('json')->response($result);
    }

    /**
     * 角色授权
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function auth($id, Request $request)
    {
        $id = (int)$id;

        //获取数据
        $perm_ids = $request->get('perm_ids');

        //权限授权
        $result = $this->adminRoleService->auth($id, $perm_ids);

        //返回响应
        return $this->tool->response($result, 'admin/adminRole');
    }

}
