<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public static $rules = [
        'content' => 'required|string|max:2000',
        'is_private' => 'required|boolean'
    ];

    public $appends = [
        '_likes',
    ];
    public function getLikesAttribute() {
        return $this->usersLiked()->pluck('id');
    }

    public function isLikedBy(User $user) {
        $likedPosts = $user->postsLiked;
        foreach ($likedPosts as $likedPost)
            if($likedPost->id === $this->id) return true;
        return false;
    }
    // Relationships
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function usersLiked() {
        return $this->belongsToMany(User::class, 'post_user_likes');
    }
}
