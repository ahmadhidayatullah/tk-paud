<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrolTamanPenitipanAnak extends Model
{
    protected $table = 'kontrol_taman_penitipan_anak';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'data_siswa_id', 'waktu', 'keterlambatan_jemput',

    ];

    public function getSiswaById()
    {
        return $this->belongsTo('App\Models\DataSiswa', 'data_siswa_id', 'id')->withDefault([
            'nama' => 'No User',
        ]);
    }

}
