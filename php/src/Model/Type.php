<?php

namespace Manager\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class of product
 */
class Type extends Model
{
    protected $fillable = [
        'name', 'tax_value'
    ];
}