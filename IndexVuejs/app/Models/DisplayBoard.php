<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DisplayBoard extends Model
{
    protected $table = 'display_boards';

    protected $fillable = ['title', 'image', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}