<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.index');
    }

    public function create()
    {
        $categories = DB::table('categories')->where('is_delete', 0)->get();
        return view('admin.service.create', compact(['categories']));
    }

    public function edit($id)
    {
        $row = Service::findOrFail($id);
        $categories = DB::table('categories')->where('is_delete', 0)->get();
        $specifications = DB::table('specifications')->where('service_id', $id)->where('is_delete', 0)->get();
        return view('admin.service.edit', compact(['row', 'categories', 'specifications']));
    }
}
