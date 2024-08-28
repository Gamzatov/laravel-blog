<?php

namespace App\Http\Requests\Post;

class PostStoreRequest extends PostCommonRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return parent::rules() +
            [
                'user_id' => [
                    'int'
                ]
            ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
