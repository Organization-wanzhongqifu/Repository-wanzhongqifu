<?php

namespace App\Http\Requests\Admin;


use App\Libs\FcAdmin\Tool;

trait FcAdminRequest
{
    public function response(array $errors)
    {
        //整理出错信息集合
        $error_data = [];
        foreach($errors as $k => $error){
            $error_data[$k] = is_array($error)&&!empty($error) ? array_shift($error) : '';
        }

        if ($this->expectsJson()) {
            return (new Tool())->setStatusCode(422)->responseError('出错!', $error_data);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->with('errors', $error_data);
    }
}