<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 初始化数据
        $this->call(AdminUserTableSeeder::class);
        $this->call(AdminPermissionTableSeeder::class);
        $this->call(AdminRoleTableSeeder::class);
    }
}
