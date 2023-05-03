<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ArticleToCategory;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryEditRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = ArticleToCategory::with('category')->orderBy('_lft')->where('article_id', 0)->get();
        return view('category.index')->with('categories', $categories);
    }

    public function create()
    {
        return view('category.create', [
            'categories' => ArticleToCategory::with('category')->orderBy('_lft')->where('article_id', 0)->get()
        ]);
    }

    public function store(CategoryRequest $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $active = $request->input('active');
        $parentId = $request->input('parent_id');

        try {
            $category = new Category();
            $category->title = $title;
            $category->description = $description;
            $category->active = $active;
            $category->slug = '';
            $category->save();
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not created.');
        }
        ArticleToCategory::insertCategoryIntoHierarchy($category, $parentId);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('category.index')->with('category', $category);
    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit', [
            'categories' => ArticleToCategory::with('category')->orderBy('_lft')->where('article_id', 0)->where('category_id', '!=', $id)->get(),
            'category' => $category
        ]);
    }

    public function update(CategoryEditRequest $request)
    {
        $title = $request->input('title');
        $description = $request->input('description');
        $active = $request->input('active');
        $parentId = $request->input('parent_id');

        $id = $request->id;

        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Category not found');
        } else {
            try {
                $category->title = $title;
                $category->description = $description;
                $category->active = $active;
                $category->save();
            } catch (\Exception $e) {
                return redirect()->route('categories.index')->with('error', 'Category not updated.');
            }
            ArticleToCategory::updateCategoryInHierarchy($category, $parentId);
            return redirect()->route('categories.index')->with('success', 'Category updated successfully');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json('Category not found');
        } else {
            ArticleToCategory::cascadeDeleteCategory($category);
            $category->delete();
            return response()->json('Category deleted successfully');
        }
    }
}
