<?php

namespace App\Http\Controllers\Wap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            return $next($request);
        });

        $menus = DB::table('menus')->where('is_delete', 0)->get();
        View::share('menus', $menus);
    }
}