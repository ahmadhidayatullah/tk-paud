<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_activity extends Model
{
    protected $table = 'user_activities';

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'subject', 'url', 'method', 'ip', 'agent', 'user_id',

    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->user_id = auth()->check() ? auth()->user()->id : 0;
        });
        self::deleting(function ($model) {
            $model->user_id = auth()->check() ? auth()->user()->id : 0;
        });
        self::updating(function ($model) {
            $model->user_id = auth()->check() ? auth()->user()->id : 0;
        });
    }

    public function getUserById()
    {
        return $this->belongsTo('App\User', 'user_id', 'id')->withDefault([
            'name' => 'No User',
        ]);
    }
}
