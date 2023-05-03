<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleService;

class ServiceController extends Controller
{
    public function getConfigAjax(Request $request)
    {
        $articleService = new ArticleService();
        $array = $request->all();
        return $articleService->returnJsonParams($array);
    }

}
