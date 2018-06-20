<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Jenssegers\Agent\Agent;

class BaseController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(function ($request, $next) {
            return $next($request);
        });

        $menus = DB::table('menus')->where('is_delete', 0)->get();
        $categories = DB::table('categories')->where('is_delete', 0)->orderBy('sort', 'asc')->get();
        foreach ($categories as $key => $category) {
            $rows = DB::table('services')->where('is_delete', 0)->where('category_id', $category->id)->orderBy('sort', 'asc')->get();
            if (count($rows) > 0) {
                $sub = array_chunk($rows->toArray(), 4);
                $categories[$key]->sub = $sub;
            }
        }

        View::share('menus', $menus);
        View::share('categories', $categories);

        // is mobile?
        $agent = new Agent();
        if ($agent->isMobile()) {
            $current = $request->path();
            Redirect::to('/wap/' . $current)->send();
        }
    }
}