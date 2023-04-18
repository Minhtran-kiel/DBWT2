<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'ab_article';

    protected $fillable = [
        'ab_name',
        'ab_price',
        'ab_decription',
        'ab_creator_id',
        'ab_create_date'
    ];
}
