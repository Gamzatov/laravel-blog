<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Common\CommonRequest;
use App\Models\Category;
use Illuminate\Validation\Rule;

class PostCommonRequest extends CommonRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'min:3',
                'max:50',
            ],
            'description' => [
                'required',
                'min:3',
                'max:5000',
            ],
            'text' => [
                'required',
                'min:3',
                'max:5000',
            ],
            'category_id' => [
                'int',
                Rule::exists(Category::class, 'id'),
            ]
        ];
    }
}
