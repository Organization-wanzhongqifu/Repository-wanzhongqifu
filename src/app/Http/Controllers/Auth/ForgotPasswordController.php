<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Merchant\resetMerchantPassword;
use App\Models\MerchantUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Mrgoon\AliSms\AliSms;

class ForgotPasswordController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('merchant.page.forget');
    }

    public function update(resetMerchantPassword $request)
    {
        $formData = $request->except('_token', '_method', 'code', 'password_confirmation', 'recharge_phone');
        $phone = $request->get('recharge_phone');
        $code = $request->get('code');
        if (Cache::has('Forgot_' . $phone)) {
            $sms_code = Cache::get('Forgot_' . $phone);
            if ($code == $sms_code) {
                $formData['password'] = bcrypt($formData['password']);
                $merchantUser = new MerchantUser();
                $merchantUser->where('phone', $phone)->update($formData);
                return redirect('login');
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
        if ($merchantUser <= 0) {
            return response()->json([
                'status' => 0,
                'message' => '未检测到与手机号匹配的商家'
            ]);
        }
        $code = rand(100000, 999999);
        $aliSms = new AliSms();
        $response = $aliSms->sendSms($phone, 'SMS_76920010', ['code'=> $code]);
        $expiresAt = Carbon::now()->addMinutes(10);
        Cache::put('Forgot_' . $phone, $code, $expiresAt);

        return response()->json([
            'status' => 1,
            'message' => '验证码发送成功'
        ]);
    }
}
