<?php

namespace App\Helpers;

class CustomHelpers
{
    public static function nilaiAngka($nilaiHuruf)
    {
        switch ($nilaiHuruf) {
            case 'A': return 4.0;
            case 'B': return 3.0;
            case 'C': return 2.0;
            case 'D': return 1.0;
            default: return 0.0;
        }
    }

    public static function nilaiHuruf($nilai)
    {
        if ($nilai >= 85) return 'A';
        else if ($nilai >= 70) return 'B';
        else if ($nilai >= 55) return 'C';
        else if ($nilai >= 40) return 'D';
        else return 'E';
    }
}
