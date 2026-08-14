<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamCategory extends Model
{
    use HasFactory;

    protected $table = 'TeamCategory';

    protected $fillable = ["name", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
