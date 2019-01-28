<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataGuru extends Model
{
    protected $table = 'data_guru';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'user_id', 'jenis_kelamin', 'tempat', 'tanggal_lahir', 'alamat', 'no_hp', 'nip', 'jabatan', 'pangkat', 'pendidikan',

    ];

    public function getUserById()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }
}
