<?php

namespace App\Http\Requests\Post;


use App\Enums\Post\PostStatusEnum;
use Illuminate\Validation\Rules\Enum;

class PostUpdateRequest extends PostCommonRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
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
