<?php
//登录
Route::get('login', 'LoginController@index'); //登录页
Route::get('logout', 'LoginController@logout'); //退出

Route::group(['middleware' => ['fcAdmin.login:admin', 'fcAdmin.permission', 'fcAdmin.auth']], function () {

    //基础路由
    Route::name('admin.index')->get('/', 'ApprovalController@index');
    Route::get('ucenter', 'UcenterController@index'); //个人中心

    //系统管理
    Route::name('admin.system.index')->get('system', 'SystemController@index');

    //管理员管理
    Route::name('admin.adminUser.index')->get('adminUser', 'AdminUserController@index');
    Route::name('admin.adminUser.create')->get('adminUser/create', 'AdminUserController@create');
    Route::name('admin.adminUser.edit')->get('adminUser/{id}/edit', 'AdminUserController@edit');
    Route::name('admin.adminUser.show')->get('adminUser/{id}', 'AdminUserController@show');

    //权限管理
    Route::name('admin.adminPermission.index')->get('adminPermission', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->get('adminPermission/create', 'AdminPermissionController@create');
    Route::name('admin.adminPermission.index')->get('adminPermission/{id}', 'AdminPermissionController@index');
    Route::name('admin.adminPermission.create')->get('adminPermission/{id}/create', 'AdminPermissionController@create');
    Route::name('admin.adminPermission.show')->get('adminPermission/{id}/show', 'AdminPermissionController@show');
    Route::name('admin.adminPermission.edit')->get('adminPermission/{id}/edit', 'AdminPermissionController@edit');

    //角色管理
    Route::name('admin.adminRole.auth')->get('adminRole/{id}/auth', 'AdminRoleController@auth'); //角色授权
    Route::name('admin.adminRole.index')->get('adminRole', 'AdminRoleController@index');
    Route::name('admin.adminRole.create')->get('adminRole/create', 'AdminRoleController@create');
    Route::name('admin.adminRole.show')->get('adminRole/{id}', 'AdminRoleController@show');
    Route::name('admin.adminRole.edit')->get('adminRole/{id}/edit', 'AdminRoleController@edit');

    // 账号管理
    Route::name('admin.admin.reset')->get('admin/reset', 'AdminController@reset');

    // 公司核名
    Route::name('admin.approval.index')->get('approvals', 'ApprovalController@index');
    Route::name('admin.approval.create')->get('approvals/create', 'ApprovalController@create');
    Route::name('admin.approval.edit')->get('approvals/{id}/edit', 'ApprovalController@edit');

    // 服务商 入驻
    Route::name('admin.provider.index')->get('providers', 'ProviderController@index');
    Route::name('admin.provider.create')->get('providers/create', 'ProviderController@create');
    Route::name('admin.provider.edit')->get('providers/{id}/edit', 'ProviderController@edit');

    // 企业服务
    Route::name('admin.enterprise.index')->get('enterprises', 'EnterpriseController@index');
    Route::name('admin.enterprise.create')->get('enterprises/create', 'EnterpriseController@create');
    Route::name('admin.enterprise.edit')->get('enterprises/{id}/edit', 'EnterpriseController@edit');

    // 热门推荐
    Route::name('admin.recommend.index')->get('recommend', 'RecommendController@index');
    Route::name('admin.recommend.create')->get('recommend/create', 'RecommendController@create');
    Route::name('admin.recommend.edit')->get('recommend/{id}/edit', 'RecommendController@edit');

    //slide
    Route::name('admin.slide.index')->get('slides', 'SlideController@index');
    Route::name('admin.slide.create')->get('slides/create', 'SlideController@create');
    Route::name('admin.slide.edit')->get('slides/{id}/edit', 'SlideController@edit');

    // 服务类型
    Route::name('admin.category.index')->get('categories', 'CategoryController@index');
    Route::name('admin.category.create')->get('categories/create', 'CategoryController@create');
    Route::name('admin.category.edit')->get('categories/{id}/edit', 'CategoryController@edit');

    // 服务管理
    Route::name('admin.service.index')->get('services', 'ServiceController@index');
    Route::name('admin.service.create')->get('services/create', 'ServiceController@create');
    Route::name('admin.service.edit')->get('services/{id}/edit', 'ServiceController@edit');

    // menu
    Route::name('admin.menu.index')->get('menus', 'MenuController@index');
    Route::name('admin.menu.create')->get('menus/create', 'MenuController@create');
    Route::name('admin.menu.edit')->get('menus/{id}/edit', 'MenuController@edit');
});

