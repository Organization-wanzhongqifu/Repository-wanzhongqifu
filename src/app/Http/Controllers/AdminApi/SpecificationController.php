<?php

namespace App\Http\Controllers\AdminApi;

use App\Models\Specification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SpecificationController extends Controller
{
    public function store(Request $request)
    {
        $model = new Specification();
        $model->service_id = $request->get('service_id');
        $model->name = $request->get('name');
        $model->price = $request->get('price');
        $model->save();
        $id = $model->id;
        return Response::json([
            'id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        DB::table('specifications')->where('id', $id)->update([
            'name' => $request->get('name'),
            'price' => $request->get('price')
        ]);
    }

    public function delete($id)
    {
        DB::table('specifications')->where('id', $id)->update(['is_delete' => 1]);
    }
}
