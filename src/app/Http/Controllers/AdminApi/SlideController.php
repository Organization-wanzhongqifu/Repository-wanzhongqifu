<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;

class SlideController extends Controller
{
    public function index()
    {
        $rows = DB::table('slides')->where('is_delete', 0)->orderBy('sort', 'asc');
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
                $buttons .= ' <a href="'. route('admin.slide.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                return $buttons;
            })->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'pc_img' => 'required',
            'wap_img' => 'required',
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Slide();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }

        $count = DB::table('slides')->count();
        $model->sort = $count + 1;
        $model->save();

        return redirect('admin/slides')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
            'pc_img' => 'required',
            'wap_img' => 'required',
        ]);

        $form_data = $request->except('_method', '_token', 'pc_img_upload', 'wap_img_upload');

        $model = new Slide();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/slides')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('slides')->where('id', $id)->delete();
        $rows = DB::table('slides')->orderBy('sort', 'asc')->get();
        if (count($rows) > 0) {
            foreach ($rows as $key => $row) {
                $index = $key + 1;
                DB::table('slides')->where('id', $row->id)->update(['sort' => $index]);
            }
        }

        if (count($rows) == 4) {
            echo 1;
        }
    }

    public function up(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('slides')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('slides')->where('sort', $sort - 1)->first();
        DB::table('slides')->where('id', $id)->update(['sort' => $sort - 1]);
        DB::table('slides')->where('id', $upper->id)->update(['sort' => $sort]);
    }

    public function down(Request $request)
    {
        $id = $request->get('id');
        $row = DB::table('slides')->where('id', $id)->first();
        $sort = $row->sort;
        $upper = DB::table('slides')->where('sort', $sort + 1)->first();
        DB::table('slides')->where('id', $id)->update(['sort' => $sort + 1]);
        DB::table('slides')->where('id', $upper->id)->update(['sort' => $sort]);
    }
}
