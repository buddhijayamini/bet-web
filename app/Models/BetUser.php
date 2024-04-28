<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetUser extends Model
{
    use HasFactory;

    protected $table = 'bet_users';

    protected $guarded = [];
}
