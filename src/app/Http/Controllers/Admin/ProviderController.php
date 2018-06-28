<?php

namespace App\Http\Controllers\Admin;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->select('id', 'name')->where('is_delete', 0)->get();
        return view('admin.provider.index', compact(['services']));
    }

    public function create()
    {
        $services = DB::table('services')->where('is_delete', 0)->get();
        return view('admin.provider.create', compact(['services']));
    }

    public function edit($id)
    {
        $row = Provider::findOrFail($id);
        $services = DB::table('services')->where('is_delete', 0)->get();
        $specifications = DB::table('specifications')->where('service_id', $row->service_id)->where('is_delete', 0)->get();
        return view('admin.provider.edit', compact(['row', 'services', 'specifications']));
    }
}
