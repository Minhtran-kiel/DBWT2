<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Shoppingcart;
use App\Models\ShoppingcartItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // add new item into shopping bag
    public function addToCart_api(Request $request){
        // get the article with given article id
        $article = Article::query()->where('id','=',$request->articleId)->first();

        // check if the cart with same creator already exists
        $cart = Shoppingcart::query()->where('ab_creator_id','=','2')->first();
        // if no create a new cart
        if(!$cart){
            $cart = new Shoppingcart;
            $cart->id = 1;
            $cart->ab_creator_id = 2;
            $cart->ab_createdate = Carbon::now();
            $cart->save();
        }

        // add item to cart
        $item = new ShoppingcartItem;
        $item->ab_shoppingcart_id = $cart->id;
        $item->ab_article_id = $article->id;
        $item->ab_createdate = Carbon::now();
        $item->save();

        if($article and $item){
            return response()->json([
                'item'=> $item,
                'message'=>'item added to waren korb successfully'
            ], 200);
        }else{
            return response()->json([
                'message'=> 'something went wrong'
            ], 500);
        }
    }

    public function removeFromCart_api($shoppingcartId, $articleId){
        $cart = Shoppingcart::query()->where('id','=',$shoppingcartId)->first();
        $item = ShoppingcartItem::query()->where('ab_shoppingcart_id','=',$shoppingcartId)
                                         ->where('ab_article_id','=',$articleId);
        
        if($item){
            $item->delete();
            return response()->json(['message' => 'Item deleted'], 200);
        }else{
            return response()->json(['message' => 'Item not found'], 404);
        }
                                        
    }
}
