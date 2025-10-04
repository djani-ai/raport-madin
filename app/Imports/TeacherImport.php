<?php

namespace App\Imports;

use App\Models\Teacher;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeacherImport implements ToCollection
{
    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {

        $rows = $collection->slice(1);
        foreach ($rows as $row) {
            Teacher::create([
                'no' => $row[0],
                'nip' => $row[1],
                'name' => $row[2],
                'phone' => $row[3],
                'address' => $row[4],
                'specialization' => $row[5],
            ]);
        }
    }
}
