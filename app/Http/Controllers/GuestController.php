<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleToCategory;
use App\Services\ArticleService;
use App\Models\Article;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $qry = ArticleToCategory::with('article')->where('article_id', '!=', 0);

        if (!isset($request->category)) {
            $articles = $qry->get();
        } else {
            $category = ArticleToCategory::where('category_id', '=', $request->category)->first();
            $articles = $qry->where('_lft', '>', $category->_lft)->where('_rgt', '<', $category->_rgt)->get();
        }
        return view('guest.home')->with('articles', $articles);
    }

    public function show($id)
    {
        $article = ArticleToCategory::with('article')->where('article_id', $id)->first();

        $articleService = new ArticleService();
        $articleQry = ArticleToCategory::with('article');
        $articles = $articleService->filterAndSort($article->article->parameters, $articleQry);
        $config = $articleService->getConfig($article->article->parameters);

        return view('guest.article.show')->with('article', $article)->with('relatedArticles', $articles)->with('config', $config);
    }
}
