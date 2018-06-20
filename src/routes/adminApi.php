<?php

Route::post('login', 'LoginController@login'); //登录处理
Route::name('admin.approval.submit')->post('approvals/submit', 'ApprovalController@submit');
Route::name('admin.enterprise.submit')->post('enterprises/submit', 'EnterpriseController@submit');
Route::name('admin.provider.submit')->post('providers/submit', 'ProviderController@submit');

Route::group(['middleware' => ['fcAdmin.login:admin', 'fcAdmin.auth']], function () {

    //个人中心
    Route::post('ucenter/edit', 'UcenterController@edit'); //修改个人资料
    Route::post('ucenter/password', 'UcenterController@password'); //修改密码
    Route::post('upload/image', 'UploadController@image'); //上传图片
    Route::post('upload/reg_form', 'UploadController@regForm'); //上传图片
    Route::post('upload/remark', 'UploadController@remark'); //上传图片

    //管理员
    Route::name('admin.adminUser.index')->get('adminUser', 'AdminUserController@index');
    Route::name('admin.adminUser.create')->post('adminUser', 'AdminUserController@store');
    Route::name('admin.adminUser.edit')->put('adminUser/{id}', 'AdminUserController@update');
    Route::name('admin.adminUser.delete')->delete('adminUser/{id}', 'AdminUserController@destroy');

    //权限
    Route::name('admin.adminPermission.index')->get('adminPermission', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.index')->get('adminPermission/{id}', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->post('adminPermission', 'AdminPermissionController@store');
    Route::name('admin.adminPermission.edit')->put('adminPermission/{id}', 'AdminPermissionController@update');
    Route::name('admin.adminPermission.delete')->delete('adminPermission/{id}', 'AdminPermissionController@destroy');

    //角色
    Route::name('admin.adminRole.auth')->put('adminRole/{id}/auth', 'AdminRoleController@auth'); //角色授权
    Route::name('admin.adminRole.index')->get('adminRole', 'AdminRoleController@index');
    Route::name('admin.adminRole.create')->post('adminRole', 'AdminRoleController@store');
    Route::name('admin.adminRole.edit')->put('adminRole/{id}', 'AdminRoleController@update');
    Route::name('admin.adminRole.delete')->delete('adminRole/{role}', 'AdminRoleController@destroy');

    // 权限管理
    Route::name('admin.admin.reset')->post('admin/reset', 'AdminController@reset');

    // 公司核名
    Route::name('admin.approval.index')->get('approvals', 'ApprovalController@index');
    Route::name('admin.approval.create')->post('approvals', 'ApprovalController@store');
    Route::name('admin.approval.import')->post('approvals/import', 'ApprovalController@import');
    Route::name('admin.approval.export')->get('approvals/export', 'ApprovalController@export');
    Route::name('admin.approval.edit')->post('approvals/{id}', 'ApprovalController@update');
    Route::name('admin.approval.delete')->post('approvals/{id}/delete', 'ApprovalController@delete');

    // 服务商入驻
    Route::name('admin.provider.index')->get('providers', 'ProviderController@index');
    Route::name('admin.provider.create')->post('providers', 'ProviderController@store');
    Route::name('admin.provider.import')->post('providers/import', 'ProviderController@import');
    Route::name('admin.provider.export')->get('providers/export', 'ProviderController@export');
    Route::name('admin.provider.edit')->post('providers/{id}', 'ProviderController@update');
    Route::name('admin.provider.delete')->post('providers/{id}/delete', 'ProviderController@delete');

    //企业服务
    Route::name('admin.enterprise.index')->get('enterprises', 'EnterpriseController@index');
    Route::name('admin.enterprise.create')->post('enterprises', 'EnterpriseController@store');
    Route::name('admin.enterprise.import')->post('enterprises/import', 'EnterpriseController@import');
    Route::name('admin.enterprise.export')->get('enterprises/export', 'EnterpriseController@export');
    Route::name('admin.enterprise.edit')->post('enterprises/{id}', 'EnterpriseController@update');
    Route::name('admin.enterprise.delete')->post('enterprises/{id}/delete', 'EnterpriseController@delete');

    // 热门推荐
    Route::name('admin.recommend.index')->get('recommend', 'RecommendController@index');
    Route::name('admin.recommend.create')->post('recommend', 'RecommendController@store');
    Route::name('admin.recommend.up')->post('recommend/up', 'RecommendController@up');
    Route::name('admin.recommend.down')->post('recommend/down', 'RecommendController@down');
    Route::name('admin.recommend.edit')->post('recommend/{id}', 'RecommendController@update');
    Route::name('admin.recommend.delete')->post('recommend/{id}/delete', 'RecommendController@delete');

    // slide
    Route::name('admin.slide.index')->get('slides', 'SlideController@index');
    Route::name('admin.slide.create')->post('slides', 'SlideController@store');
    Route::name('admin.slide.up')->post('slides/up', 'SlideController@up');
    Route::name('admin.slide.down')->post('slides/down', 'SlideController@down');
    Route::name('admin.slide.edit')->post('slides/{id}', 'SlideController@update');
    Route::name('admin.slide.delete')->post('slides/{id}/delete', 'SlideController@delete');

    // category
    Route::name('admin.category.index')->get('categories', 'CategoryController@index');
    Route::name('admin.category.create')->post('categories', 'CategoryController@store');
    Route::name('admin.category.up')->post('categories/up', 'CategoryController@up');
    Route::name('admin.category.down')->post('categories/down', 'CategoryController@down');
    Route::name('admin.category.edit')->post('categories/{id}', 'CategoryController@update');
    Route::name('admin.category.delete')->post('categories/{id}/delete', 'CategoryController@delete');

    // service
    Route::name('admin.service.index')->get('services', 'ServiceController@index');
    Route::name('admin.service.create')->post('services', 'ServiceController@store');
    Route::name('admin.service.field')->post('services/field', 'ServiceController@field');
    Route::name('admin.service.edit')->post('services/{id}', 'ServiceController@update');
    Route::name('admin.service.specification')->post('services/{id}/specifications', 'ServiceController@specification');
    Route::name('admin.service.delete')->post('services/{id}/delete', 'ServiceController@delete');

    // menu
    Route::name('admin.menu.index')->get('menus', 'MenuController@index');
    Route::name('admin.menu.create')->post('menus', 'MenuController@store');
    Route::name('admin.menu.edit')->post('menus/{id}', 'MenuController@update');
    Route::name('admin.menu.delete')->post('menus/{id}/delete', 'MenuController@delete');

    // 规格
    Route::name('admin.specification.create')->post('specifications', 'SpecificationController@store');
    Route::name('admin.specification.edit')->post('specifications/{id}', 'SpecificationController@update');
    Route::name('admin.specification.delete')->post('specifications/{id}/delete', 'SpecificationController@delete');
});
