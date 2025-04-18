<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'url',
        'title',
        'category',
        'tags',
        'description',
        'thumbnail',
        'views',
        'likes'
    ];
    
    /**
     * Get the user that owns the bookmark.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
