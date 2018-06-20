<?php

use Illuminate\Database\Seeder;

class AdminPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_time = date('Y-m-d H:i:s');
        $data = [
            ['id' => 1, 'rule' => 'admin.system.index', 'name' => '人员管理', 'description' => '人员管理', 'pid' => 0, 'icon' => 'fa-cog', 'sort' => 20, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 2, 'rule' => 'admin.adminUser.index', 'name' => '人员管理', 'description' => '人员管理', 'pid' => 1, 'icon' => '', 'sort' => 0, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 4, 'rule' => 'admin.adminRole.index', 'name' => '角色管理', 'description' => '角色管理', 'pid' => 1, 'icon' => '', 'sort' => 2, 'is_menu' => 1, 'created_at' => $date_time],

            // Other Modules
            ['id' => 5, 'rule' => 'admin.apply.index', 'name' => '需求管理', 'description' => '需求管理', 'pid' => 0, 'icon' => 'fa-cog', 'sort' => 0, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 6, 'rule' => 'admin.approval.index', 'name' => '企业核名', 'description' => '企业核名', 'pid' => 5, 'icon' => '', 'sort' => 1, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 7, 'rule' => 'admin.provider.index', 'name' => '服务商入驻', 'description' => '服务商入驻', 'pid' => 5, 'icon' => '', 'sort' => 2, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 8, 'rule' => 'admin.enterprise.index', 'name' => '企业服务', 'description' => '企业服务', 'pid' => 5, 'icon' => 'f', 'sort' => 3, 'is_menu' => 1, 'created_at' => $date_time],

            ['id' => 9, 'rule' => 'admin.service.index', 'name' => '服务管理', 'description' => '服务管理', 'pid' => 0, 'icon' => 'fa-cog', 'sort' => 1, 'is_menu' => 1, 'created_at' => $date_time],

            ['id' => 10, 'rule' => 'admin.home.index', 'name' => '首页管理', 'description' => '首页管理', 'pid' => 0, 'icon' => 'fa-cog', 'sort' => 2, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 11, 'rule' => 'admin.menu.index', 'name' => '导航栏管理', 'description' => '导航栏管理', 'pid' => 10, 'icon' => '', 'sort' => 0, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 12, 'rule' => 'admin.category.index', 'name' => '服务类型管理', 'description' => '服务类型管理', 'pid' => 10, 'icon' => '', 'sort' => 1, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 13, 'rule' => 'admin.recommend.index', 'name' => '热门推荐管理', 'description' => '热门推荐管理', 'pid' => 10, 'icon' => '', 'sort' => 2, 'is_menu' => 1, 'created_at' => $date_time],
            ['id' => 14, 'rule' => 'admin.slide.index', 'name' => '轮播图管理', 'description' => '轮播图管理', 'pid' => 10, 'icon' => '', 'sort' => 3, 'is_menu' => 1, 'created_at' => $date_time],
        ];

        DB::table('admin_permissions')->insert($data);
    }
}
