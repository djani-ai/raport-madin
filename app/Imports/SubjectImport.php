<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubjectImport implements ToCollection
{

    public function collection(Collection $collection)
    {

        $rows = $collection->slice(1);
        foreach ($rows as $row) {
            Subject::create([
                'no' => $row[0],
                'name' => $row[1],
                'arabic_name' => $row[2],
            ]);
        }
    }
}
