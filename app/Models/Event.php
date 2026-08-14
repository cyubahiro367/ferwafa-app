<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'Event';

    protected $fillable = ["name", "description", "statusID", "event_date", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
