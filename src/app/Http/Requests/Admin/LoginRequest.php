<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

/**
 * 后台登录请求
 * Class LoginRequest
 * @package App\Http\Requests\Admin
 */
class LoginRequest extends FormRequest
{
    use FcAdminRequest;

    protected $dontFlash = ['password'];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * 提示消息
     * @return array
     */
    public function messages()
    {
        return [
            'user.required' => '请填写用户名或邮箱!',
            'password.required' => '请填写密码!'
        ];
    }

}
