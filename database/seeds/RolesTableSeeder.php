<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'admin'],
            ['name' => 'guru'],
            ['name' => 'wali'],

        ];
        DB::table('roles')->insert($data);
    }
}
