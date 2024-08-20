<?php

namespace App\Helpers;

if (!function_exists('nilaiHuruf')) {
    function nilaiHuruf($nilai) {
        if ($nilai >= 85) return 'A';
        elseif ($nilai >= 70) return 'B';
        elseif ($nilai >= 55) return 'C';
        elseif ($nilai >= 40) return 'D';
        else return 'E';
    }
}

if (!function_exists('nilaiAngka')) {
    function nilaiAngka($huruf) {
        switch ($huruf) {
            case 'A': return 4;
            case 'B': return 3;
            case 'C': return 2;
            case 'D': return 1;
            default: return 0;
        }
    }
}
