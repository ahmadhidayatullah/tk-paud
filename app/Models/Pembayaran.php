<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'jenis_pembayaran', 'data_siswa_id', 'tanggal', 'bayar', 'total_denda',

    ];

    public function getSiswaById()
    {
        return $this->belongsTo('App\Models\DataSiswa', 'data_siswa_id', 'id')->withDefault([
            'nama' => 'No User',
        ]);
    }
}
