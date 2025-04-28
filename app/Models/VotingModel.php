<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotingModel extends Model
{
    use HasFactory;

    // protected fillable
    protected $fillable = ['name', 'phone', 'pName', 'pImage', 'pDetails', 'liveLink', 'githubLink', 'status'];
}
