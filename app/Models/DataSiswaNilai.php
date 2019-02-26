<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswaNilai extends Model
{
    protected $table = 'data_siswa_nilai';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'data_siswa_id', 'pendahuluan', 'agama', 'fisik_motorik', 'sosial_emosional', 'bahasa', 'kognitif', 'seni', 'penutup',

    ];
}
