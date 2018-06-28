<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Zhuzhichao\IpLocationZh\Ip;

class IndexController extends BaseController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index(Request $request)
    {
        $vars = Ip::find($request->ip());
        $city = '';

        // 热门推荐 363 * 400
        $recommends = DB::table('recommend')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        // slide
        $slides = DB::table('slides')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        return view('web.index', compact(['city', 'recommends', 'slides']));
    }

    public function about()
    {
        return view('web.about');
    }

    public function services()
    {
        return view('web.enterprise');
    }
}
