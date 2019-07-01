<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'user_id', 'name', 'title', 'cover',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
