<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $table = 'Day';

    protected $fillable = ["name", "abbreviation", "seasonID", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
