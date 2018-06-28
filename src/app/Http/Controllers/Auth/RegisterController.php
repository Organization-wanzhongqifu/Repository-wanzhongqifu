<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\storeMerchantRegister;
use App\Models\MerchantApply;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Mrgoon\AliSms\AliSms;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        $markets = DB::table('markets')->select('id', 'market_name as name')->get();
        return view('merchant.page.register', compact('markets'));
    }

    public function store(storeMerchantRegister $request)
    {
        $phone = $request->get('charge_phone');
        $code = $request->get('code');
        $formData = $request->except('_token', '_method', 'code');
        if (Cache::has('Register_' . $phone)) {
            $sms_code = Cache::get('Register_' . $phone);
            if ($code == $sms_code) {
                $apply = new MerchantApply();
                foreach ($formData as $k => $v) {
                    $apply->$k = $v;
                }
                $apply->save();
                return redirect('review');
            } else {
                return Redirect::back()->withInput()->withErrors(['code' => '验证码错误']);
            }
        } else {
            return Redirect::back()->withInput();
        }
    }

    public function sendSms(Request $request)
    {
        $phone = $request->get('phone');
        $merchantUser = DB::table('merchant_users')->where('phone', '=', $phone)->count();
        if (!$merchantUser) {
            $code = rand(100000, 999999);
            $aliSms = new AliSms();
            $response = $aliSms->sendSms($phone, 'SMS_76920010', ['code'=> $code]);
            $expiresAt = Carbon::now()->addMinutes(10);
            Cache::put('Register_' . $phone, $code, $expiresAt);
            return response()->json(['status' => 1, 'msg' => '验证码发送成功']);
        } else {
            return response()->json(['status' => 0, 'msg' => '此手机号已经注册']);
        }
    }
}
