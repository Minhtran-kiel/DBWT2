<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

/**
 * Controller for tasks refered to articles
 */
class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $articles = Article::query()->where('ab_name', 'ilike', '%' . $searchTerm . '%')->get();
        return view('articles', compact('articles', 'searchTerm'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ], [
            'name.required' => 'Please enter the name of the article.',
            'price.required' => 'Please enter the price of the article.',
            'price.numeric' => 'The price of the article must be a number.',
            'price.min' => 'The price of the article must be at least 0.',
            'description.required' => 'Please enter a description of the article.',
        ]);

        // Persist the validated data to the database
        $article = new Article;
        $article->id = 31;
        $article->ab_name = $validatedData['name'];
        $article->ab_price = $validatedData['price'];
        $article->ab_description = $validatedData['description'];
        $article->ab_creator_id = 6;
        $article->ab_createdate = \Carbon\Carbon::now();
        $article->save();

        return redirect('/articles')->with('success', 'Article added successfully!');
    }

    public function kategorien()
    {
        return view('kategorien');
    }

    public function verkaufen()
    {
        return view('verkaufen');
    }
}
