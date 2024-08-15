<?php

namespace App\Enums\Post;

enum PostStatusEnum: int
{
    case DRAFT = 1;
    case PUBLISHED = 2;
    case ARCHIEVED = 3;

    /**
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::PUBLISHED => 'Published',
            self::ARCHIEVED => 'Archived',
        };
    }

    public function color ()
    {
        return match ($this) {
            self::DRAFT => 'secondary',
            self::PUBLISHED => 'success',
            self::ARCHIEVED => 'dark',
        };
    }
}
