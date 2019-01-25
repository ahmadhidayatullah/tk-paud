<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisBiayaSiswa extends Model
{
    protected $table = 'jenis_biaya_siswa';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'nama', 'pendaftaran', 'pangkal', 'seragam', 'bulanan', 'denda_permenit', 'keterangan',

    ];

}
