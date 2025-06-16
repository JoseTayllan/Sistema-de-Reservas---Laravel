<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espaco extends Model
{
     protected $fillable = [
        'nome',
        'descricao',
        'capacidade',
        'horario_abertura',
        'horario_fechamento',
    ];
}
