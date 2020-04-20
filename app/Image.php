<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'path',
        'imagable_id',
        'imagable_type',
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
