<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategorySelect extends Component
{
    // Объявляем свойство $categories
    public Collection $categories;

    /**
     * Создайте новый экземпляр компонента.
     * @param Collection $categories
     * @param Post $post
     */
    public function __construct(
        public Collection $categories,
        public Post|null  $post
    )

    {
        // Присваиваем коллекцию категорий свойству $categories
        $this->categories = Category::all();
    }

    /**
     * Получите представление / содержимое, представляющее компонент.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-select');
    }
}
