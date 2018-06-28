<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recommend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecommendController extends Controller
{
    public function index()
    {
        return view('admin.recommend.index');
    }

    public function create()
    {
        return view('admin.recommend.create');
    }

    public function edit($id)
    {
        $row = Recommend::findOrFail($id);
        return view('admin.recommend.edit', compact(['row']));
    }
}
