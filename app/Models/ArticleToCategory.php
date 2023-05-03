<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Kalnoy\Nestedset\NodeTrait;

class ArticleToCategory extends Pivot
{
    use NodeTrait;

    protected $nodeTraitClass = NodeTrait::class;
    public $timestamps = false;
    public $incrementing = false;

    protected $table = 'article_to_categories';

    protected $parentColumn = 'parent_id';
    protected $leftColumn = '_lft';
    protected $rightColumn = '_rgt';

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function insertCategoryIntoHierarchy(Category $category, int $parentId = null)
    {
        try {
            $node = new ArticleToCategory(['article_id' => 0, 'category_id' => $category->id]);

            if ($parentId != 0) {
                $parent = ArticleToCategory::find($parentId);
                $node->parent_id = $parent->id;
            } else {
                $node->parent_id = null;
            }

            $node->save();
        } catch (\Exception $e) {
            $category->delete();
            return redirect()->route('categories.index')->with('error', 'Category not created.');
        }
    }

    public static function updateCategoryInHierarchy(Category $category, int $parentId = null)
    {
        try {
            $node = ArticleToCategory::where('article_id', 0)->where('category_id', $category->id)->first();

            if ($parentId != 0) {
                $parent = ArticleToCategory::find($parentId);
                $node->parent_id = $parent->id;
            } else {
                $node->parent_id = null;
            }
            $node->save();
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not updated.');
        }
    }

    public static function cascadeDeleteCategory(Category $category)
    {
        try {
            $node = ArticleToCategory::where('article_id', 0)->where('category_id', $category->id)->orderBy('_rgt', 'desc')->first();
            $descendents = ArticleToCategory::where('_rgt', '<', $node->_rgt)->where('_lft', '>', $node->_lft)->get();

            if (!is_null($descendents)) {

                foreach ($descendents as $descendent) {
                    Category::where('id', $descendent->category_id)->delete();
                    Article::where('id', $descendent->article_id)->delete();
                    $descendent->delete();
                }
            }

            $node->delete();
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not updated.');
        }
    }

    public static function setCategoriesForArticle(Article $article, array $categoryIds)
    {
        try {
            foreach ($categoryIds as $categoryId) {

                $pivotNode = ArticleToCategory::where('article_id', 0)->where('category_id', $categoryId)->first();

                $node = new ArticleToCategory();
                $node->article_id = $article->id;
                $node->category_id = $pivotNode->category_id;
                $node->parent_id = $pivotNode->id;
                $node->save();
            }
        } catch (\Exception $e) {
            $article->delete();
            return redirect()->route('categories.index')->with('error', 'Article not created.');
        }
    }

    public static function updateCategoriesForArticle(Article $article, array $categoryIds)
    {
        try {
            ArticleToCategory::where('article_id', $article->id)->whereNotIn('category_id', $categoryIds)->delete();
            foreach ($categoryIds as $categoryId) {

                $pivotNode = ArticleToCategory::where('article_id', 0)->where('category_id', $categoryId)->first();

                $node = new ArticleToCategory();
                $node->article_id = $article->id;
                $node->category_id = $pivotNode->category_id;
                $node->parent_id = $pivotNode->id;
                $node->save();
            }
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not updated.');
        }
    }

    public static function deleteArticleWhereExists(Article $article)
    {
        try {
            ArticleToCategory::where('article_id', $article->id)->delete();
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not updated.');
        }
    }
}
