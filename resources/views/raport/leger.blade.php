<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Leger Kelas - {{ $classroom->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/report/report-style.css') }}">
    <style>
        /* Tambahan style khusus untuk leger */
        .report-container {
            width: 95%;
            /* Leger biasanya lebih lebar */
            max-width: 1200px;
        }

        .report-header .title {
            font-size: 24px;
        }

        .report-card th.subject-header {
            writing-mode: vertical-rl;
            /* Membuat teks header mapel menjadi vertikal */
            transform: rotate(180deg);
            white-space: nowrap;
            text-align: left;
            padding-bottom: 10px;
        }

        .report-card {
            font-size: 12px;
            /* Ukuran font lebih kecil untuk memuat banyak data */
        }

        .report-card td,
        .report-card th {
            padding: 4px 5px;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <div class="report-header">
            <div class="title">LEGER NILAI SANTRI</div>
            <div class="student-info">
                <div class="info-left">
                    <table>
                        <tr>
                            <td>Kelas</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td class="font-bold">{{ $classroom->name }}</td>
                        </tr>
                        <tr>
                            <td>Wali Kelas</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ optional($classroom->hr_teacher)->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="info-right">
                    <table>
                        <tr>
                            <td>Tahun Pelajaran</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ optional($classroom->school_year)->name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <table class="report-card" style="margin-top: 20px;">
            <thead>
                <tr class="header-row">
                    <th rowspan="2" colspan="1">No</th>
                    <th rowspan="2" colspan="3">Nama Santri</th>
                    <th colspan="{{ count($subjects) }}">Mata Pelajaran</th>
                    <th rowspan="2">Jumlah Nilai</th>
                    <th rowspan="2">Rata-Rata</th>
                    <th rowspan="2">Peringkat</th>
                </tr>
                <tr class="header-row">
                    @forelse ($subjects as $subject)
                        <th class="subject-header">{{ $subject->name }}</th>
                    @empty
                        <th>-</th>
                    @endforelse
                </tr>
            </thead>
            <tbody>
                @forelse ($classroom->students as $studentClassroom)
                    <tr class="{{ $loop->odd ? 'grade-row-odd' : 'grade-row-even' }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td colspan="3">{{ $studentClassroom->name }}</td>
                        @foreach ($subjects as $subject)
                            <td class="text-center">
                                {{ $grades[$studentClassroom->id][$subject->id] ?? '-' }}
                            </td>
                        @endforeach
                        <td class="text-center font-bold">
                            {{ $studentReports[$studentClassroom->id]['total_score'] ?? '-' }}
                        </td>
                        <td class="text-center font-bold">
                            {{ $studentReports[$studentClassroom->id]['average'] ?? '-' }}

                        </td>
                        <td class="text-center font-bold">
                            {{ $studentReports[$studentClassroom->id]['rank'] ?? '-' }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        {{-- +5 karena ada kolom No, Nama, Jumlah, Rata-rata, Peringkat --}}
                        <td colspan="{{ count($subjects) + 5 }}" class="text-center">
                            Tidak ada data siswa di kelas ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
