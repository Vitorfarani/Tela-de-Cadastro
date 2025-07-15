<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CpfValido implements Rule
{
    public function passes($attribute, $value)
    {
        // rejeita sequências iguais
        if (preg_match('/^(\d)\1{10}$/', $value)) {
            return false;
        }

        // primeiro dígito verificador
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += $value[$i] * (10 - $i);
        }
        $dv1 = ($sum * 10) % 11;
        $dv1 = $dv1 === 10 ? 0 : $dv1;
        if ($dv1 != $value[9]) {
            return false;
        }

        // segundo dígito verificador
        $sum = 0;
        for ($i = 0; $i < 10; $i++) {
            $sum += $value[$i] * (11 - $i);
        }
        $dv2 = ($sum * 10) % 11;
        $dv2 = $dv2 === 10 ? 0 : $dv2;
        if ($dv2 != $value[10]) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'CPF inválido.';
    }
}
