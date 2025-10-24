<?php

namespace App\Imports;

use App\Models\Value; // Sesuaikan dengan model Nilai Anda
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ScheduleValuesImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * Tentukan kolom mana yang menjadi kunci unik.
     * Kita akan menggunakan 'schedule_id' dan 'student_id'.
     */
    public function uniqueBy()
    {
        return ['school_year', 'schedule_id', 'student_id'];
    }

    /**
     * Proses setiap baris dari file Excel
     */
    public function model(array $row)
    {
        // --- LOGIKA VALIDASI DIPERBAIKI ---
        // Periksa apakah data KUNCI (selain nilai) ada dan tidak null/kosong
        // Kita gunakan !isset atau === '' untuk memastikan
        if (
            !isset($row['schedule_id']) || $row['schedule_id'] === '' ||
            !isset($row['student_id']) || $row['student_id'] === '' ||
            !isset($row['school_year_id']) || $row['school_year_id'] === ''
        ) {

            // Lewati baris jika data kunci tidak lengkap
            Log::warning('Melewati baris impor karena data KUNCI tidak lengkap: ' . json_encode($row));
            return null;
        }

        // Periksa apakah kolom 'nilai' ada.
        // array_key_exists akan lolos meskipun nilainya null (sel kosong)
        if (!array_key_exists('nilai', $row)) {
            Log::warning('Melewati baris impor karena kolom "nilai" tidak ditemukan: ' . json_encode($row));
            return null;
        }
        // --- AKHIR PERBAIKAN VALIDASI ---

        // 'updateOrCreate' akan ditangani secara otomatis oleh WithUpserts
        // Kita hanya perlu mereturn data modelnya.
        return new Value([
            // Lakukan casting (ubah) ke (int) untuk memastikan tipe data cocok
            'schedule_id'    => (int) $row['schedule_id'],
            'student_id'     => (int) $row['student_id'],
            'school_year_id' => (int) $row['school_year_id'],
            'value'          => (int) $row['nilai'], // Biarkan apa adanya (bisa null jika sel kosong)

        ]);
    }
}
