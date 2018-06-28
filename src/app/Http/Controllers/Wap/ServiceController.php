<?php

namespace App\Http\Controllers\Wap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ServiceController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function show($name)
    {
        $service = DB::table('services')->where('route', $name)->first();
        $specifications = DB::table('specifications')->where('service_id', $service->id)->where('is_delete', 0)->get();
        return view('wap.service', compact(['service', 'specifications']));
    }
}
