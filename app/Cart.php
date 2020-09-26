<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id', 'name', 'price', 'quantity', 'amount'];
    public $timestamps = false;
}
