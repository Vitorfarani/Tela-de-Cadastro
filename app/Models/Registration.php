<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'sexo',
        'telefone',
        'data_nascimento',
        'cpf',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // CPF com pontuação
    public function getCpfFormatadoAttribute()
    {
        return preg_replace(
            '/(\d{3})(\d{3})(\d{3})(\d{2})/',
            '$1.$2.$3-$4',
            $this->cpf
        );
    }

    // Telefone formatado
    public function getTelefoneFormatadoAttribute()
    {
        $t = preg_replace('/\D/', '', $this->telefone);
        if (strlen($t) === 11) {
            return '('.substr($t,0,2).') '.substr($t,2,5).'-'.substr($t,7);
        }
        return '('.substr($t,0,2).') '.substr($t,2,4).'-'.substr($t,6);
    }
}
