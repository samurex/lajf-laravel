<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;
use Storage;

class Declaration extends Model
{
    use Geographical;

    protected static $kilometers = true;

    protected $fillable = [
        'user_id',
        'mood_id',
        'scale',
        'feelings',
        'hashtag_id',
        'share',
        'latitude',
        'longitude',
    ];

    protected $appends = ['image_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hashtag()
    {
        return $this->belongsTo(Hashtag::class);
    }

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imagable');
    }

    public function getImageUrlAttribute()
    {
        return $this->image !== null ? asset(Storage::url($this->image->path)) : null;
    }
}
