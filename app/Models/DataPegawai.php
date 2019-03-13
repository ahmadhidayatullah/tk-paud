<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPegawai extends Model
{
    protected $table = 'data_pegawai';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'user_id', 'jenis_kelamin', 'tempat', 'tanggal_lahir', 'alamat', 'no_hp', 'nuptk', 'nip', 'jabatan', 'pangkat_gol', 'pangkat_tmt', 'pendidikan_jenjang', 'pendidikan_jurusan', 'tmt_kgb', 'ket',

    ];

    public function getUserById()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }
}
