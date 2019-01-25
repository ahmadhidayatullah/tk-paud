<?php

namespace App\Helpers;

use DB;

class Biaya
{
    public static function hitungBiaya($id_siswa)
    {
        if ('tk') {
            $data['bulan'] = 350000;
        } else {
            if ('seharian') {
                $data['bulan'] = 800000;
            } else {
                $data['bulan'] = 650000;
            }
        }

        return DB::table('data_siswa')->count();
    }
}
