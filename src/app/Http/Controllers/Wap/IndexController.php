<?php

namespace App\Http\Controllers\Wap;

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
        $slides = DB::table('slides')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        $recommends = DB::table('recommend')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        return view('wap.index', compact(['slides', 'recommends']));
    }

    public function about()
    {
        return view('wap.about');
    }

    public function category()
    {
        $categories = DB::table('categories')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        foreach ($categories as $key => $category) {
            $rows = DB::table('services')->where('is_delete', 0)->where('category_id', $category->id)->orderBy('sort', 'asc')->get();
            if (count($rows) > 0) {
                $categories[$key]->sub = $rows;
            } else {
                $categories[$key]->sub = [];
            }
        }
        return view('wap.category', compact(['categories']));
    }

    /**
     * 服务商入口
     */
    public function services()
    {
        return view('wap.provider');
    }
}
