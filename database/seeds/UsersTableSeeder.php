<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //seeder tahun ke
        $data = [
            [
                'name' => 'ahmad',
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'role_id' => 1,
                'is_active' => true,
            ],

        ];
        DB::table('users')->insert($data);
    }
}
