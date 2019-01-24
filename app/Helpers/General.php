<?php

namespace App\Helpers;

use DB;

class General
{
    public static function countRawTable($table)
    {
        return DB::table($table)->count();
    }
}
