<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'photo', 'price', 'product_description'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
