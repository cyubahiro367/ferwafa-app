<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopScore extends Model
{
    use HasFactory;

    protected $table = 'TopScore';

    protected $fillable = ["name", "goals", "teamName", "divisionID", "categoryID", "seasonID", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
