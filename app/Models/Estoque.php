<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $fillable = ['fornecedors_id', 'produtos_id', 'qtd', 'unit', 'custoTotal', 'vlVenda'];
    use HasFactory;
}
