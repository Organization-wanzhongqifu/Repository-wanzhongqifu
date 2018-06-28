<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Facades\Datatables;

class ProviderController extends Controller
{
    public function index(Request $request)
    {
        $rows = DB::table('providers')
            ->select('providers.*', DB::raw('hm_services.name as service_name'), DB::raw('hm_specifications.name as specification'))
            ->leftJoin('services', 'services.id', '=', 'providers.service_id')
            ->leftJoin('specifications', 'providers.specification_id', '=', 'specifications.id')
            ->where('providers.is_delete', 0)->orderBy('providers.created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                if ($row->origin_from == 2) {
                    $buttons = ' <a href="' . route('admin.provider.edit', [$row->id]) . '" class="btn btn-xs btn-primary"> 编辑</a>';
                    $buttons .= ' <a href="javascript:;" data-id="' . $row->id . '" class="btn btn-xs btn-primary delete"> 删除</a>';
                    return $buttons;
                } else {
                    return '-';
                }
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $search = $request->get('search');
                    $query->where(function ($query) use ($search) {
                        $query->where('providers.name', '=', $search);
                        $query->orWhere('providers.mobile', '=', $search);
                    });
                }

                if ($request->has('province')) {
                    $city = $request->get('province');
                    $query->where('service_province', '=', $city);
                }

                if ($request->has('city')) {
                    $city = $request->get('city');
                    $query->where('service_city', '=', $city);
                }

                if ($request->has('begin') && $request->has('end')) {
                    $begin = $request->get('begin');
                    $end = $request->get('end') . ' 23:59:59';
                    $query->where('providers.created_at', '>=', $begin);
                    $query->where('providers.created_at', '<=', $end);
                }

                if ($request->has('service') && $request->get('service') != 0) {
                    $service_id = $request->get('service');
                    $query->where('providers.service_id', $service_id);
                }
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'mobile' => 'required|digits:11',
            'specification_id' => 'required',
            'service_id' => 'required'
        ], [
            'mobile.digits' => '联系方式 格式不正确'
        ]);

        if (!$request->get('service_province') || !$request->get('service_city') || !$request->get('service_district')) {
            return Redirect::back()->withInput()->withErrors(['service_city' => '服务区域 不能为空']);
        }

        $formData = $request->except('_method', '_token');
        $model = new Provider();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $model->origin_from = 2;
        $model->save();

        return redirect('admin/providers')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'mobile' => 'required|digits:11',
            'specification_id' => 'required',
            'service_id' => 'required'
        ], [
            'mobile.digits' => '联系方式 格式不正确'
        ]);

        if (!$request->get('service_province') || !$request->get('service_city') || !$request->get('service_district')) {
            return Redirect::back()->withInput()->withErrors(['service_city' => '服务区域 不能为空']);
        }

        $form_data = $request->except('_method', '_token');

        $model = new Provider();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/providers')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('providers')->where('id', $id)->update(['is_delete' => 1]);
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric',
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Provider();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $model->save();
    }

    public function import(Request $request)
    {
        $excel = $request->file('file');
        $filename = md5($excel) .'.'. $excel->getClientOriginalExtension();
        $excel->move(storage_path() . '/excel/', $filename);
        $path = storage_path().'/excel/'.$filename;
        $excel = App::make('excel');
        $excel->selectSheetsByIndex(0)->load($path, function ($reader) use ($path) {
            DB::beginTransaction();
            try {
                $results = $reader->all();
                foreach ($results as $result) {
                    $specification = $result->商品规格;
                    $service = $result->服务名称;
                    $row1 = DB::table('specifications')->where('name', $specification)->first();
                    $row2 = DB::table('services')->where('name', $service)->first();
                    if ($result->联系称呼 && $row1->id && $row2->id) {
                        $model = new Provider();
                        $model->name = $result->联系称呼;
                        $model->mobile = $result->联系方式;
                        $arr = explode('/', $result->服务区域);
                        $model->service_province = $arr[0];
                        $model->service_city = $arr[1];
                        $model->service_district = $arr[2];
                        $model->specification_id = $row1->id;
                        $model->service_id = $row2->id;
                        $model->origin_from = 2;
                        $model->save();
                    }
                }
                DB::commit();
                unlink($path);
                echo json_encode([
                    'status' => 1,
                    'message' => 'success'
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                unlink($path);
                echo json_encode([
                    'status' => 0,
                    'message' => '出现错误导致导入失败，请检查后重试'
                ]);
            }

        });
    }

    public function export(Request $request)
    {
        $begin_time = $request->get('begin_time');
        $end_time = $request->get('end_time');

        $approval = new Provider();
        $rows = $approval->select(
            DB::raw('hm_providers.created_at as 提交时间'),
            DB::raw('hm_providers.name as 联系称呼'),
            DB::raw('hm_providers.mobile as 联系方式'),
            'service_province',
            'service_city',
            'service_district',
            DB::raw('hm_specifications.name as 商品规格'),
            DB::raw('hm_services.name as 服务名称'),
            'origin_from'
        )
            ->join('specifications', 'specifications.id', '=', 'providers.specification_id')
            ->join('services', 'services.id', '=', 'providers.service_id')
            ->where('providers.is_delete', 0)
            ->where('providers.created_at', '>=', $begin_time)
            ->where('providers.created_at', '<=', $end_time)
            ->get();
        foreach ($rows as $key => $row) {
            $rows[$key]->服务区域 = $row->service_province . $row->service_city . $row->service_district;
            $rows[$key]->所属来源 = $row->origin_from == 1 ? '网站' : '后台';
            unset($rows[$key]->service_province);
            unset($rows[$key]->service_city);
            unset($rows[$key]->service_district);
            unset($rows[$key]->origin_from);
        }
        $excel = App::make('excel');
        $excel->create('服务商入驻', function($excel) use($rows) {
            $excel->sheet('Sheet 1', function($sheet) use($rows) {
                $sheet->fromArray($rows);
            });
        })->export('xls');
    }
}
