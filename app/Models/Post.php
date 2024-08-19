<?php

namespace App\Models;

use App\Enums\Post\PostStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

/**
 * @property int user_id
 * @property int category_id
 * @property string description
 * @property string title
 * @property string text
 * @property PostStatusEnum status
 *
 * @property User[]|Collection user
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'text',
        'status',
        'user_id',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'status' => PostStatusEnum::class
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
