<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $count = DB::table('menus')->where('is_delete', 0)->count();
        return view('admin.menu.index', compact('count'));
    }

    public function create()
    {
        return view('admin.menu.create');
    }

    public function edit($id)
    {
        $row = Menu::findOrFail($id);
        return view('admin.menu.edit', compact(['row']));
    }
}
