<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Recommend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class RecommendController extends Controller
{
    public function index()
    {
        $rows = DB::table('recommend')->where('is_delete', 0)->orderBy('sort', 'asc');
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
                $buttons .= ' <a href="'. route('admin.recommend.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                return $buttons;
            })->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
            'url' => 'required|url',
            'bg_img' => 'required'
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Recommend();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $count = DB::table('recommend')->count();
        $model->sort = $count + 1;
        $model->save();

        return redirect('admin/recommend')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:10',
            'url' => 'required|url',
            'bg_img' => 'required'
        ]);

        $form_data = $request->except('_method', '_token', 'bg_img_upload');

        $model = new Recommend();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/recommend')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('recommend')->where('id', $id)->delete();
        $rows = DB::table('recommend')->orderBy('sort', 'asc')->get();
        if (count($rows) > 0) {
            foreach ($rows as $key => $row) {
                $index = $key + 1;
                DB::table('recommend')->where('id', $row->id)->update(['sort' => $index]);
            }
        }
    }

    public function up(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('recommend')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('recommend')->where('sort', $sort - 1)->first();
        DB::table('recommend')->where('id', $id)->update(['sort' => $sort - 1]);
        DB::table('recommend')->where('id', $upper->id)->update(['sort' => $sort]);
    }

    public function down(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('recommend')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('recommend')->where('sort', $sort + 1)->first();
        DB::table('recommend')->where('id', $id)->update(['sort' => $sort + 1]);
        DB::table('recommend')->where('id', $upper->id)->update(['sort' => $sort]);
    }
}
