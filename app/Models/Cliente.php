<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nomeClient', 'EndCliente', 'tel1Cliente', 'tel2Client'];
    use HasFactory;
}
