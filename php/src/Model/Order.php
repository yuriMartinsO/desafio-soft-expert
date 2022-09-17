<?php

namespace Manager\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class of order
 */
class Order extends Model
{
    protected $fillable = ['total_tax', 'total_product', 'total'];
}
