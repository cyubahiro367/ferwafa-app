<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    
    protected $table = 'Partner';

    protected $fillable = ["link", "image_url", "userID"];

    public function creator()
    {
        return $this->belongsTo(User::class, "userID");
    }
}
