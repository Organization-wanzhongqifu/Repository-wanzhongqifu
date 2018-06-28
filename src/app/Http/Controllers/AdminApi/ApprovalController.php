<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Approval;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel;
use Yajra\Datatables\Facades\Datatables;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $rows = DB::table('approvals')->where('is_delete', 0)->orderBy('created_at', 'desc');
        return Datatables::of($rows)
            ->addColumn('action', function ($row) {
                if ($row->origin_from == 2) {
                    $buttons = ' <a href="'. route('admin.approval.edit', [$row->id]) .'" class="btn btn-xs btn-primary"> 编辑</a>';
                    $buttons .= ' <a href="javascript:;" data-id="'. $row->id .'" class="btn btn-xs btn-primary delete"> 删除</a>';
                    return $buttons;
                } else {
                    return '-';
                }
            })
            ->filter(function ($query) use ($request) {
                if ($request->has('search')) {
                    $search = $request->get('search');
                    $query->where(function ($query) use ($search) {
                        $query->where('name', '=', $search);
                        $query->orWhere('mobile', '=', $search);
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
                    $query->where('created_at', '>=', $begin);
                    $query->where('created_at', '<=', $end);
                }
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'mobile' => 'required|digits:11',
            'company_name' => 'required'
        ], [
            'mobile.digits' => '联系方式 格式不正确'
        ]);

        if (!$request->get('province') || !$request->get('city')) {
            return Redirect::back()->withInput()->withErrors(['city' => '公司城市 不能为空']);
        }

        if (!$request->get('service_province') || !$request->get('service_city') || !$request->get('service_district')) {
            return Redirect::back()->withInput()->withErrors(['service_city' => '服务区域 不能为空']);
        }

        $formData = $request->except('_method', '_token');
        $model = new Approval();
        //创建账号
        foreach ($formData as $k => $v){
            $model->$k = $v;
        }
        $model->origin_from = 2;
        $model->save();

        return redirect('admin/approvals')->with('prompt', ['status' => 1, 'msg' => '新增成功']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:5',
            'mobile' => 'required|digits:11',
            'company_name' => 'required'
        ], [
            'mobile.digits' => '联系方式 格式不正确'
        ]);

        if (!$request->get('province') || !$request->get('city')) {
            return Redirect::back()->withInput()->withErrors(['city' => '公司城市 不能为空']);
        }

        if (!$request->get('service_province') || !$request->get('service_city') || !$request->get('service_district')) {
            return Redirect::back()->withInput()->withErrors(['service_city' => '服务区域 不能为空']);
        }

        $form_data = $request->except('_method', '_token');

        $model = new Approval();
        $model->where('id', $id)->update($form_data);
        return redirect('admin/approvals')->with('prompt', ['status' => 1, 'msg' => '更新成功']);
    }

    public function delete($id)
    {
        DB::table('approvals')->where('id', $id)->update(['is_delete' => 1]);
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required|numeric'
        ]);
        $formData = $request->except('_method', '_token');
        $model = new Approval();
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
                    if ($result->联系称呼) {
                        $model = new Approval();
                        $model->name = $result->联系称呼;
                        $model->mobile = $result->联系方式;
                        $arr = explode('/', $result->服务区域);
                        $model->service_province = $arr[0];
                        $model->service_city = $arr[1];
                        $model->service_district = $arr[2];
                        $model->city = $result->公司所在城市;
                        $model->company_name = $result->公司名称;
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

        $approval = new Approval();
        $rows = $approval->select(
            DB::raw('created_at as 提交时间'),
            DB::raw('name as 联系称呼'),
            DB::raw('mobile as 联系方式'),
            'service_province',
            'service_city',
            'service_district',
            DB::raw('city as 公司所在城市'),
            DB::raw('company_name as 公司名称'),
            'origin_from'
        )->where('is_delete', 0)
            ->where('created_at', '>=', $begin_time)
            ->where('created_at', '<=', $end_time)
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
        $excel->create('公司核名', function($excel) use($rows) {
            $excel->sheet('Sheet 1', function($sheet) use($rows) {
                $sheet->fromArray($rows);
            });
        })->export('xls');
    }
}
