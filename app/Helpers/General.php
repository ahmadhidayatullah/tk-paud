<?php

namespace App\Helpers;

use DB;

class General
{
    public static function countRawTable($table)
    {
        return DB::table($table)->count();
    }

    public static function toRupiah($number)
    {
        if ($number >= 0) {
            return 'Rp. ' . number_format($number, 0, ',', '.');
        } else {
            $input = abs($number) * -1;
            $result = number_format($input);
            return 'Rp. ' . $result;
        }
    }
}
