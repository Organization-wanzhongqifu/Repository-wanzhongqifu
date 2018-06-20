<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $count = DB::table('categories')->where('is_delete', 0)->count();
        return view('admin.category.index', compact('count'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function edit($id)
    {
        $row = Category::findOrFail($id);
        $services = DB::table('services')->select('id', 'name', 'highlight', 'sort')->where('category_id', $id)->where('is_delete', 0)->get();
        return view('admin.category.edit', compact(['row', 'services']));
    }
}
