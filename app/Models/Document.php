<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'Document';

    protected $fillable = ["title", "url", "type_id", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
