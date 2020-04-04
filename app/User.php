<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * Set a UUID on create.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $unique = false;
            do {
                $uuid = Str::uuid();
                if (Self::where('uuid', $uuid)->count() == 0) {
                    $unique = true;
                }
            } while (!$unique);
    
            $model->uuid = $uuid;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dob',
        'gender',
        'city',
        'occupation',
        'long',
        'lat',
    ];
}
