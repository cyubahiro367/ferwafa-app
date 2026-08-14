<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'News';

    protected $fillable = ["title", "caption", "description", "is_top", "image", "statusID", "newsTypeID", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
