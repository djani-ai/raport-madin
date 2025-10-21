<?php

namespace App\Imports;

use App\Models\Value;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ScheduleValuesImport implements ToCollection
{

    public function collection(Collection $collection)
    {

        $rows = $collection->slice(1);
        foreach ($rows as $row) {
            Value::updated([
                // 'student_number' => $row[1],
                // 'national_id' => $row[2],
                // 'name' => $row[3],
                // 'gender' => $row[4],
                // 'birth_place' => $row[5],
                // 'birth_date' => is_numeric($row[6])
                //     ? Date::excelToDateTimeObject($row[6])->format('d-m-Y')
                //     : Carbon::parse($row[6])->format('d-m-Y'),
                // 'religion' => $row[7],
                // 'child_number' => $row[8],
                // 'family_status' => $row[9],
                // 'address' => $row[10],
                // 'school_name'   => $row[11],
                // 'father_name' => $row[12],
                // 'mother_name' => $row[13],
                // 'father_national_id' => $row[14],
                // 'mother_national_id' => $row[15],
                // 'father_job' => $row[16],
                // 'mother_job' => $row[17],
            ]);
        }
    }
}
