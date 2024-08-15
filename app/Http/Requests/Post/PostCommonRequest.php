<?php

namespace App\Http\Requests\Post;

use App\Http\Requests\Common\CommonRequest;

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
        ];
    }
}
