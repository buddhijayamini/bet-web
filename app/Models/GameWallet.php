<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameWallet extends Model
{
    use HasFactory;

    protected $table = 'game_wallets';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
