<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $table = 'Team';

    protected $fillable = ['name', 'logo', 'categoryID', 'divisionID'];
}
