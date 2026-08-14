<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'Gallery';

    protected $fillable = ["name", "url", "height", "width", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
