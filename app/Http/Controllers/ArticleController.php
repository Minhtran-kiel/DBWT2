<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function index_api(Request $request)
    {
        $searchTerm = $request->input('search');
        $articles = Article::query()->where('ab_name', 'ilike', '%' . $searchTerm  . '%')->get();
        return response()->json(['articles' => $articles], 200);
    }

    public function store_api(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1',
            'price' => 'required|numeric|min:1',
            'description' => 'string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ], 422);
        } else {
            $article = new Article;
            $article->id = 31;
            $article->ab_name = $request->name;
            $article->ab_price = $request->price;
            $article->ab_description = $request->description;
            $article->ab_creator_id = 6;
            $article->ab_createdate = \Carbon\Carbon::now();
            $article->save();
        }

        if ($article) {
            return response()->json([
                'id' => $article->id,
                'message' => 'new article created successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
        ]);

        $existingArticle = Article::query()->where('ab_name','=', $validatedData['name'])->first();
        if($existingArticle){
            return response()->json(['message' => 'Article already exists.'], 409);
        }

        // Persist the validated data to the database
        $article = new Article;
        $article->id = 31;
        $article->ab_name = $validatedData['name'];
        $article->ab_price = $validatedData['price'];
        $article->ab_description = $validatedData['description'];
        $article->ab_creator_id = 6;
        $article->ab_createdate = \Carbon\Carbon::now();
        $article->save();

        // when using AJAX, the response from the server is received by the cleint-side js code
        // and it's up to the js code to handle the response
        // so this line will not work as expected 
        // -> Lösung: redirect using window.location.href in client-side js code
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
