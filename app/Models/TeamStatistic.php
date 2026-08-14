<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamStatistic extends Model
{
    use HasFactory;

    protected $table = 'TeamStatistic';

    protected $fillable = ["gameID", "teamID", "goalWin", "goalLoss", "score", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
