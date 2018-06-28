<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enterprise;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EnterpriseController extends Controller
{
    public function index()
    {
        return view('admin.enterprise.index');
    }

    public function create()
    {
        return view('admin.enterprise.create');
    }

    public function edit($id)
    {
        $row = Enterprise::findOrFail($id);
        return view('admin.enterprise.edit', compact(['row']));
    }
}
