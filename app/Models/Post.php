<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $keyType = 'string';
    protected $fillable = ['id', 'title', 'description', 'user_id'];
}
