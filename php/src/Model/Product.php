<?php

namespace Manager\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class of product
 */
class Product extends Model
{
    protected $fillable = [
        'name', 'type', 'price'
    ];
}