<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['title', 'content', 'price', 'stock', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}