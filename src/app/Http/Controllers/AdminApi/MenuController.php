<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class MenuController extends Controller
{
    public function index()
    {
        $rows = DB::table('menus')->where('is_delete', 0)->orderBy('created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                $buttons = ' <a href="'. route('admin.menu.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                return $buttons;
            })->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'url' => 'required|url'
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Menu();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $model->save();

        return redirect('admin/menus')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'url' => 'required|url'
        ]);

        $form_data = $request->except('_method', '_token');

        $model = new Menu();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/menus')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('menus')->where('id', $id)->delete();
        $count = DB::table('menus')->count();
        if ($count == 4) {
            echo 1;
        }
    }
}
