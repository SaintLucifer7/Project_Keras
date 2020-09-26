<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public $timestamps = false;
    protected $fillable = ['product_id', 'type', 'quantity', 'created_at'];
}
