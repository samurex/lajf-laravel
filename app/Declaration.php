<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Declaration extends Model
{
    protected $fillable = [
        'user_id',
        'question_1',
        'question_2',
        'question_3',
        'temperature',
        'latitude',
        'longitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
