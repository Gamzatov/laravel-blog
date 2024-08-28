<?php

namespace App\Http\Requests\Post;

use App\Enums\Post\PostStatusEnum;
use Illuminate\Validation\Rules\Enum;

class PostUpdateRequest extends PostCommonRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return parent::rules() + [
                'status' => [
                    'int',
                    new Enum(PostStatusEnum::class)
                ]
            ];
    }
}
