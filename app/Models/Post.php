<?php

namespace App\Models;

use App\Enums\Post\PostStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'text',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'status' => PostStatusEnum::class
        ];
    }
}
