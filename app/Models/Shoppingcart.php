<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    use HasFactory;

    protected $table = 'ab_shoppingcart';
    const CREATED_AT = null;
    const UPDATED_AT = null;

    protected $fillable = [
        'id',
        'ab_creator_id',
        'ab_createdate'
    ];
}
