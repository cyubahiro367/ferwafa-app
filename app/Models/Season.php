<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'Season';

    protected $fillable = ["from", "to", "playsInGroups", "userID"];

    protected $casts = [
        'playsInGroups' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
