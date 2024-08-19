<?php

namespace App\Policies;

use App\Enums\User\UserRoleEnum;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function owner(User $user, Post $post): bool
    {
        return $post->user_id === $user->getKey() || $user->isAdmin();
    }
}
