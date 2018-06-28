<?php

use Illuminate\Database\Seeder;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_users')->insert([
            [
                'name' => Config::get('fc_admin.username'),
                'nickname' => '超级管理员',
                'email' => Config::get('fc_admin.email'),
                'password' => bcrypt(Config::get('fc_admin.password')),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }
}
