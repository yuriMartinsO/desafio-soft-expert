<?php

namespace Manager\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class of order product
 */
class OrderProduct extends Model
{
    protected $fillable = ['product_id', 'type_id', 'product_total', 'tax_total', 'quantity', 'total', 'order'];
}
