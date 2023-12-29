<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function follower(){
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }

    public function followed(){
        return $this->belongsTo(User::class, 'followed_id')->withTrashed();
    }

    public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
    }
}
