<?php

use Illuminate\Database\Seeder;

class AdminRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d');
        $data = [
            [
                'name' => '管理员',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ];

        DB::table('admin_roles')->insert($data);
    }
}
