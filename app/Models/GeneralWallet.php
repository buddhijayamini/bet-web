<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralWallet extends Model
{
    use HasFactory;

    protected $table = 'general_wallets';

    protected $guarded = [];
}
