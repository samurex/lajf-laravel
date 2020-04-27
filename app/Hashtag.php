<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function declarations()
    {
        return $this->hasMany(Declaration::class);
    }

    public function publicDeclarations()
    {
        return $this->hasMany(Declaration::class)->where('share', 1);
    }
}
