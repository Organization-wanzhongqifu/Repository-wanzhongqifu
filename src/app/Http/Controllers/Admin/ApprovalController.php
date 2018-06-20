<?php

namespace App\Http\Controllers\Admin;

use App\Models\Approval;
use App\Http\Controllers\Controller;

class ApprovalController extends Controller
{
    public function index()
    {
        return view('admin.approval.index');
    }

    public function create()
    {
        return view('admin.approval.create');
    }

    public function edit($id)
    {
        $row = Approval::findOrFail($id);
        return view('admin.approval.edit', compact(['row']));
    }
}
