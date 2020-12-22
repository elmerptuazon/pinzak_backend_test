<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title', 'author_id', 'article', 'is_published'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'author_id');
    }
}
