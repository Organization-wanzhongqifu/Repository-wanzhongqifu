<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SlideController extends Controller
{
    public function index()
    {
        $count = DB::table('slides')->where('is_delete', 0)->count();
        return view('admin.slide.index', compact('count'));
    }

    public function create()
    {
        return view('admin.slide.create');
    }

    public function edit($id)
    {
        $row = Slide::findOrFail($id);
        return view('admin.slide.edit', compact(['row']));
    }
}
