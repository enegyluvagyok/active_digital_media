<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ArticleToCategory;

class CategoryTree extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = ArticleToCategory::with('category')->where('article_id', 0)->orderBy('_lft', 'asc')->get();
        return view('components.category-tree')->with('categories', $categories);
    }

}
