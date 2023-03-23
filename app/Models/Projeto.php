<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    use HasFactory;
    protected $fillable = ['nome_projeto', 'uuid','descricao', 'data_inicio', 'data_fim', 'edital','categorias', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
