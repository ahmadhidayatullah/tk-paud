<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UmumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'kepsek' => 'kepsek',
                'a1' => 'Wali Kelas A1',
                'a2' => 'Wali Kelas A2',
                'b1' => 'Wali Kelas B1',
                'b2' => 'Wali Kelas B2',
                'b3' => 'Wali Kelas B3',
                'b4' => 'Wali Kelas B4',
            ],

        ];
        DB::table('umums')->insert($data);
    }
}
