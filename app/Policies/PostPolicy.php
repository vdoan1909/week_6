<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PostPolicy
{
    public function viewAny(User $user): bool
    {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    public function view(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }


    public function create(User $user): bool
    {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;

    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id == $post->user_id;
    }
}
