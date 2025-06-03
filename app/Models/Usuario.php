<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    public $fillable = [
        'id',
        'nome',
        'email',
        'senha',
        'dataNasc',
        'genero',
        'altura',
        'peso',
        'foto'
    ];
}
