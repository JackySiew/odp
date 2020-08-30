<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable =[
        'comment',
        'rating',
        'product_id'
    ];
}
