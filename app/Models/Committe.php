<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committe extends Model
{
    use HasFactory;

    protected $table = 'Committe';

    protected $fillable = ["name", "position", "age", "nationality", "description", "image_url", "committeeCategoryID", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
