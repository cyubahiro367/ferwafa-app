<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerSuspended extends Model
{
    use HasFactory;

    protected $table = 'PlayerSuspended';

    protected $fillable = [
        'seasonID',
        'dayID',
        'teamID',
        'name',
        'reason',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class, 'seasonID');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'dayID');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'teamID');
    }
}
