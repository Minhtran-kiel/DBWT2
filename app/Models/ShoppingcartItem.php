<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingcartItem extends Model
{
    use HasFactory;

    protected $table = 'ab_shoppingcart_item';
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'ab_shoppingcart_id',
        'ab_article_id',
        'ab_createdate'
    ];

}
