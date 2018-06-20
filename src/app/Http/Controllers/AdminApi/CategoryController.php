<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class CategoryController extends Controller
{
    public function index()
    {
        $rows = DB::table('categories')->where('is_delete', 0)->orderBy('sort', 'asc');
        $count = $rows->count();
        return Datatables::of($rows)
            ->addColumn('action', function ($row) use ($count) {
                $buttons = '';
                if ($row->sort == 1 && $count != 1) {
                    $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary down"> 下移</a>';
                } else if ($row->sort == $count) {
                    $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary up"> 上移</a>';
                } else {
                    $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary down"> 下移</a>';
                    $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary up"> 上移</a>';
                }
                $buttons .= ' <a href="'. route('admin.category.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                return $buttons;
            })->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'icon' => 'required'
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Category();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $count = DB::table('categories')->count();
        $model->sort = $count + 1;
        $model->save();

        return redirect('admin/categories')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'icon' => 'required'
        ]);

        $form_data = $request->except('_method', '_token', 'icon_upload', 'highlight', 'sort');

        $model = new Category();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/categories')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        $rows = DB::table('categories')->orderBy('sort', 'asc')->get();
        if (count($rows) > 0) {
            foreach ($rows as $key => $row) {
                $index = $key + 1;
                DB::table('categories')->where('id', $row->id)->update(['sort' => $index]);
            }
        }

        if (count($rows) == 5) {
            echo 1;
        }
    }

    public function up(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('categories')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('categories')->where('sort', $sort - 1)->first();
        DB::table('categories')->where('id', $id)->update(['sort' => $sort - 1]);
        DB::table('categories')->where('id', $upper->id)->update(['sort' => $sort]);
    }

    public function down(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('categories')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('categories')->where('sort', $sort + 1)->first();
        DB::table('categories')->where('id', $id)->update(['sort' => $sort + 1]);
        DB::table('categories')->where('id', $upper->id)->update(['sort' => $sort]);
    }
}
