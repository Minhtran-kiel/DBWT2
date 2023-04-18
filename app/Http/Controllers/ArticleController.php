<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //
    public function index(Request $request){
        $searchTerm = $request->input('search');
        $articles = Article::query()->where('ab_name','ilike','%'.$searchTerm.'%')->get();
        return view('index', compact('articles','searchTerm'));
    }
}
