<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = ["id"] ;

    protected $casts = [
        'products_details' => 'array',
    ];
}
