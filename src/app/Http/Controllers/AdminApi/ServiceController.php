<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Service;
use App\Models\Specification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\Datatables\Facades\Datatables;

class ServiceController extends Controller
{
    public function index()
    {
        $rows = DB::table('services')
            ->leftJoin('categories', 'services.category_id', '=', 'categories.id')
            ->select('services.id', DB::raw('hm_services.name as service_name'), DB::raw('hm_categories.name as category_name'))
            ->where('services.is_delete', 0)->orderBy('services.created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                $buttons = ' <a href="'. route('admin.service.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                return $buttons;
            })->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'category_id' => 'required',
            'route' => 'required|alpha_dash|unique:services',
            'thumb' => 'required',
            'sname' => 'required',
            'pc_text' => 'required',
            'wap_text' => 'required'
        ], [
            'route.required' => '命名URL 不能为空',
            'category_id.required' => '服务类型 不能为空'
        ]);
        $formData = $request->except('_method', '_token', 'sname', 'sprice', 'thumb_upload');
        $model = new Service();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $model->save();

        // 增加规格
        $sname = $request->get('sname');
        $sprice = $request->get('sprice');
        foreach ($sname as $k => $v) {
            $m = new Specification();
            $m->service_id = $model->id;
            $m->name = $v;
            $m->price = $sprice[$k];
            $m->save();
        }

        return redirect('admin/services')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'route' => 'required|alpha_dash|unique:services,route,' . $id
        ]);

        $form_data = $request->except('_method', '_token', 'sname', 'sprice', 'service_id', 'thumb_upload');

        $model = new Service();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/services')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('services')->where('id', $id)->update(['is_delete' => 1]);
    }

    /**
     * 获得specification
     */
    public function specification($service_id)
    {
        $specifications = DB::table('specifications')
            ->select('id', 'name')
            ->where('service_id', $service_id)->where('is_delete', 0)->get();
        return Response::json($specifications);
    }


    public function field(Request $request)
    {
        $key = $request->get('key');
        $value = $request->get('value');
        $service_id = $request->get('id');
        $fields = ['sort', 'highlight'];

        if (in_array($key, $fields)) {
            DB::table('services')->where('id', $service_id)->update([$key => $value]);
        }
    }
}
