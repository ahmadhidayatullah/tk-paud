<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    protected $table = 'data_siswa';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'user_id', 'nis', 'nama', 'kelas', 'jenis_kelamin', 'tempat', 'tanggal_lahir', 'pekerjaan_orang_tua', 'alamat', 'no_hp', 'jenis_biaya_siswa_id', 'jenis_bayar',

    ];

    public function getUserById()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }

    public function getJenisBiayaById()
    {
        return $this->belongsTo('App\Models\JenisBiayaSiswa', 'jenis_biaya_siswa_id', 'id')->withDefault([
            'nama' => 'No User',
        ]);
    }

    public function getPembayaran()
    {
        return $this->hasMany('App\Models\Pembayaran', 'data_siswa_id', 'id');
    }

}
