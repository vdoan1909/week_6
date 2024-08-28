<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TagPolicy
{
    public function viewAny(User $user): bool
    {
        return Auth::check();
    }

    public function view(User $user, Tag $tag): bool
    {
        return $user->id == $tag->user_id;
    }

    public function create(User $user): bool
    {
        return Auth::check();
    }

    public function update(User $user, Tag $tag): bool
    {
        return $user->id == $tag->user_id;

    }

    public function delete(User $user, Tag $tag): bool
    {
        return $user->id == $tag->user_id;

    }
}
