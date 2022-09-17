<?php

namespace Manager\Model;

use Illuminate\Database\Eloquent\Model;
use Manager\Model\Type;

/**
 * Class of product
 */
class Product extends Model
{
    protected $fillable = [
        'name', 'type', 'price'
    ];
}