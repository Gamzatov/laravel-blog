<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    public function owner(User $user, Comment $comment): bool
    {
        return $comment->user_id === $user->getKey() || $user->isAdmin();
    }
}
