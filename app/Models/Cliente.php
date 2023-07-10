<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nomeClient', 'EndClient', 'tel1Client', 'tel2Client', 'users_id'];
    use HasFactory;
}
