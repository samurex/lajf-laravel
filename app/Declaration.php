<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $fillable = [
        'user_id',
        'mood_id',
        'scale',
        'feelings',
        'share',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }
}
