<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'ab_article';
    const CREATED_AT = null;
    const UPDATED_AT = null;
    

    protected $fillable = [
        'ab_name',
        'ab_price',
        'ab_description',
        'ab_creator_id',
        'ab_create_date'
    ];
}
