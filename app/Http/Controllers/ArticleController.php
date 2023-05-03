<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleToCategory;

use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleEditRequest;

use App\Services\ArticleService;

use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::all();
        return view('article.index')->with('articles', $articles);
    }

    public function create()
    {
        $categories = $categories = ArticleToCategory::with('category')->where('article_id', 0)->orderBy('_lft', 'asc')->get();
        return view('article.create', [
            'categories' => $categories,
            'articleService' => new ArticleService()
        ]);
    }

    public function store(ArticleRequest $request)
    {

        $title = $request->input('title');
        $intro = $request->input('intro');
        $content = $request->input('content');
        $categories = $request->input('category');
        $parameters = $request->input('parameters');

        try {
            $article = new Article();
            $article->title = $title;
            $article->intro = $intro;
            $article->content = $content;
            $article->parameters = $parameters;
            $article->slug = '';

            if (isset($request->image)) {
                $path = $request->file('image')->store('public/images');
                $url = Storage::url($path);
                $article->image = $url;
            }

            $article->save();
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Category not created.');
        }

        ArticleToCategory::setCategoriesForArticle($article, $categories);
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show($id)
    {
        $articleService = new ArticleService();
        $article = Article::find($id);
        $articleQry = ArticleToCategory::with('article');
        $articles = $articleService->filterAndSort($article->parameters, $articleQry);
        $config = $articleService->getConfig($article->parameters);
        return view('article.show')->with('article', $article)->with('relatedArticles', $articles)->with('config', $config);
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $categories = ArticleToCategory::with('category')->where('article_id', 0)->orderBy('_lft', 'asc')->get();
        return view('article.edit')->with('article', $article)->with('categories', $categories);
    }

    public function update(ArticleEditRequest $request, $id)
    {

        $title = $request->input('title');
        $intro = $request->input('intro');
        $content = $request->input('content');
        $active = $request->input('active');
        $categories = $request->input('category');
        $parameters = $request->input('parameters');

        $article = Article::find($id);

        if (!$article) {
            return redirect()->route('articles.index')->with('error', 'Article not found.');
        } else {
            try {
                $article->title = $title;
                $article->intro = $intro;
                $article->content = $content;
                $article->active = $active;
                $article->parameters = $parameters;

                if (isset($request->image)) {
                    $path = $request->file('image')->store('public/images');
                    $url = Storage::url($path);
                    $article->image = $url;
                }

                $article->save();
            } catch (\Exception $e) {
                return redirect()->route('articles.index')->with('error', 'Article not updated.');
            }
        }
        ArticleToCategory::updateCategoriesForArticle($article, $categories);
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json('Article not found');
        } else {
            ArticleToCategory::deleteArticleWhereExists($article);
            $article->delete();
            return response()->json('Article deleted successfully');
        }
    }
}
