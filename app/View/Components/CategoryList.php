<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class CategoryList extends Component
{
    /**
     * Создайте новый экземпляр компонента.
     */
    public function __construct(
        public Collection $categories
    )
    {
// Присвоение коллекции категорий свойству $categories
        $this->categories = Category::all();
    }

    /**
     * Получите представление / содержимое, представляющее компонент.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-list');
    }
}
