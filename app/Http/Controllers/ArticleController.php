<?php

namespace App\Http\Controllers;

require __DIR__. '/../../../vendor/autoload.php';

use App\Models\Article;
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
        // Pagination parameters
        $page = $request->input('page', 1); // Default to page 1 if not provided
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        // Fetch paginated articles based on search term
        $articles = Article::query()
            ->where('ab_name', 'ilike', '%' . $searchTerm . '%')
            ->offset($offset)
            ->limit($perPage)
            ->get();

        // Count the total number of articles (without pagination)
        $totalCount = Article::query()
            ->where('ab_name', 'ilike', '%' . $searchTerm . '%')
            ->count();

        $totalPages = ceil($totalCount / $perPage);

        return response()->json(
            [
                'articles' => $articles,
                'totalPages' => $totalPages
            ],
            200
        );
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

        $existingArticle = Article::query()->where('ab_name', '=', $validatedData['name'])->first();
        if ($existingArticle) {
            return response()->json(['message' => 'Article already exists.'], 409);
        }

        // Persist the validated data to the database
        $article = new Article;
        //$article->id = 31;
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

    public function sell_api(Request $request, $id)
    {

        //Get the article and user information
        $article = Article::query()->where('id', '=', $id)->first();
        $sellerId = $article->ab_creator_id;


        //Prepare data to send to the WebSocket server
        $data = [
            'userId' => $sellerId,
            'articleId' => $id,
            'message' => "Great! Your article '{$article->ab_name}' was sold successfully!",
        ];

        \Ratchet\Client\connect('ws://localhost:8085/sell')
            ->then(
                function ($conn) use ($data) {
                    $conn->on('message', function ($msg) use ($conn) {
                        echo "Received: {$msg}\n";
                        $conn->close();
                    });
                    $conn->send(json_encode($data));
                },
                function ($e) {
                    echo "Cound not connect: {$e->getMessage()}\n";
                }
            ); 
        return response()->json([
            'message' => 'Article sold successfully',
        ]);
    }

    function checkArticleOwnership_api(Request $request){
        $articleId = $request->input('articleId');
        $userId = $request->input('userId');

        $article = Article::query()->where('id', '=', $articleId)->where('ab_creator_id', '=', $userId)->first();
        if($article !== null){
            return response()->json(['message' => true], 200);
        }
        else{
            return response()->json(['message' => 'something went wrong'], 500);
        }
    }

    function sendNotification_api(Request $request){
        $articleId = $request->input('articleId');
    
        //Get the article and user information
        $article = Article::query()->where('id', '=', $articleId)->first();
        $userId = $article->ab_creator_id;
        
        // preparedata to send to Websocketserver
        $data = [
            'userId' => $userId,
            'articleId' => $articleId,
            'message' => "Der Artikel '{$article->ab_name}' wird nun guenstiger angeboten! Greifen Sie schnell zu.",
        ];

        \Ratchet\Client\connect('ws://localhost:8086/angebot')
            ->then(
                function ($conn) use ($data) {
                    $conn->on('message', function ($msg) use ($conn) {
                        echo "Received: {$msg}\n";
                        $conn->close();
                    });
                    $conn->send(json_encode($data));
                    $conn->close();
                },
                function ($e) {
                    echo "Cound not connect: {$e->getMessage()}\n";
                }
            ); 
        return response()->json([
            'message' => 'Article angeboten!',
        ]);
    }
}
