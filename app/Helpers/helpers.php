<?php


use Riskihajar\Terbilang\Facades\Terbilang;

if (!function_exists('getPersonalityDescription')) {

    function getPersonalityDescription($grade)
    {
        switch (strtoupper($grade)) {
            case 'A':
                return 'Sangat Baik';
            case 'B':
                return 'Baik';
            case 'C':
                return 'Cukup';
            case 'D':
                return 'Kurang';
            default:
                return '-';
        }
    }
}

if (!function_exists('numberToWords')) {

    function numberToWords($number)
    {

        if (!is_numeric($number) || empty($number)) {
            return '';
        }
        if (class_exists(Terbilang::class)) {
            return trim(Terbilang::make($number));
        }
        return 'Package Terbilang belum siap.';
    }
}

if (!function_exists('toEasternArabicNumerals')) {

    function toEasternArabicNumerals($number)
    {
        if (!is_numeric($number)) {
            return '';
        }
        if ($number == 0) {
            return '٠';
        }
        $westernArabic = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $easternArabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        return str_replace($westernArabic, $easternArabic, $number);
    }
}

if (!function_exists('numberToWordsArabic')) {

    function numberToWordsArabic($number)
    {
        if (!is_numeric($number) || $number < 0 || $number > 999) {
            return '';
        }
        if ($number == 0) {
            return 'صفر';
        }
        $units = [
            1 => 'واحد',
            2 => 'اثنان',
            3 => 'ثلاثة',
            4 => 'أربعة',
            5 => 'خمسة',
            6 => 'ستة',
            7 => 'سبعة',
            8 => 'ثمانية',
            9 => 'تسعة',
        ];
        $teens = [
            11 => 'أحد عشر',
            12 => 'اثنا عشر',
            13 => 'ثلاثة عشر',
            14 => 'أربعة عشر',
            15 => 'خمسة عشر',
            16 => 'ستة عشر',
            17 => 'سبعة عشر',
            18 => 'ثمانية عشر',
            19 => 'تسعة عشر',
        ];
        $tens = [
            10 => 'عشرة',
            20 => 'عشرون',
            30 => 'ثلاثون',
            40 => 'أربعون',
            50 => 'خمسون',
            60 => 'ستون',
            70 => 'سبعون',
            80 => 'ثمانون',
            90 => 'تسعون',
        ];
        $hundreds = [100 => 'مائة', 200 => 'مئتان'];
        $result = [];
        $h = floor($number / 100);
        if ($h > 0) {
            if ($h == 1) $result[] = $hundreds[100];
            elseif ($h == 2) $result[] = $hundreds[200];
            else $result[] = $units[$h] . 'مائة';
        }
        $remainder = $number % 100;
        if ($remainder > 0) {
            if (!empty($result)) $result[] = 'و';
            if ($remainder < 10) $result[] = $units[$remainder];
            elseif ($remainder == 10) $result[] = $tens[$remainder];
            elseif ($remainder > 10 && $remainder < 20) $result[] = $teens[$remainder];
            else {
                $u = $remainder % 10;
                $t = floor($remainder / 10) * 10;
                if ($u > 0) {
                    $result[] = $units[$u];
                    $result[] = 'و';
                }
                $result[] = $tens[$t];
            }
        }
        return implode(' ', $result);
    }
}
