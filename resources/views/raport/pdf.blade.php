<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Raport {{ $report->student->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/report/report-style.css') }}">
</head>

<body>
    <div class="report-container">
        <!-- Header Section (Dinamis) -->
        <div class="report-header">
            <div><img width="100%" src="{{ asset('storage/kop.jpg') }}" alt="" srcset=""></div>
            <div class="title">كشف الدرجات</div>
            <div class="student-info">
                <div class="info-left">
                    <table>
                        <tr>
                            <td>Nama Santri</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td class="font-bold">{{ optional($report->student)->name }}</td>
                        </tr>
                        <tr>
                            <td>Orang Tua/Wali</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ optional($report->student)->guardian_name ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="info-right">
                    <table>
                        <tr>
                            <td>Kelas</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ optional($report->classroom)->name }}</td>
                        </tr>
                        <tr>
                            <td>Tahun Pelajaran</td>
                            <td>&nbsp;:&nbsp;</td>
                            <td>{{ optional($report->schoolYear)->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Grades Table Section (Dinamis) -->
        <table class="report-card">
            <colgroup>
                <col style="width: 42.2px">
                <col style="width: 85.2px">
                <col style="width: 67.2px">
                <col style="width: 57.2px">
                <col style="width: 147.2px">
                <col style="width: 26.2px">
                <col style="width: 143.2px">
                <col style="width: 24.2px">
                <col style="width: 57.2px">
                <col style="width: 26.2px">
                <col style="width: 26.2px">
                <col style="width: 26.2px">
                <col style="width: 26.2px">
                <col style="width: 26.2px">
                <col style="width: 42.2px">
            </colgroup>
            <tbody>
                <tr class="header-row">
                    <th rowspan="2">No</th>
                    <th colspan="2" rowspan="2">Mata Pelajaran</th>
                    <th colspan="2">Hasil Tes</th>
                    <td class="vertical-divider" rowspan="{{ max(($report->values ?? collect())->count(), 13) + 4 }}">
                    </td>
                    <th colspan="3">النتائج</th>
                    <th colspan="5" rowspan="2">المواد الدراسية</th>
                    <th rowspan="2">النمرة</th>
                </tr>
                <tr class="header-row">
                    <th>Angka</th>
                    <th>Huruf</th>
                    <th colspan="2">با لحروف</th>
                    <th>با لأرقام</th>
                </tr>

                @php
                    // Mengurutkan data nilai berdasarkan ID mata pelajaran untuk konsistensi
                    $sortedValues = ($report->values ?? collect())->sortBy(function ($value) {
                        return optional(optional($value->schedule)->subject)->id ?? 999;
                    });
                @endphp

                @forelse ($sortedValues as $value)
                    <tr class="{{ $loop->odd ? 'grade-row-odd' : 'grade-row-even' }}">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td colspan="2">{{ optional(optional($value->schedule)->subject)->name }}</td>
                        <td class="text-center">{{ $value->value ?? '-' }}</td>
                        <td class="font-italic">{{ numberToWords($value->value) }}</td>
                        <td class="text-right" colspan="2">{{ numberToWordsArabic($value->value) }}</td>
                        <td class="text-center font-bold">{{ toEasternArabicNumerals($value->value) }}</td>
                        <td class="text-right" colspan="5">
                            {{ optional(optional($value->schedule)->subject)->arabic_name ?? optional(optional($value->schedule)->subject)->name }}
                        </td>
                        <td class="text-center">{{ toEasternArabicNumerals($loop->iteration) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center">Belum ada data nilai untuk ditampilkan.</td>
                    </tr>
                @endforelse

                @for ($i = ($report->values ?? collect())->count(); $i < 13; $i++)
                    <tr class="{{ ($i + 1) % 2 != 0 ? 'grade-row-odd' : 'grade-row-even' }}">
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                        <td></td>
                        <td colspan="5"></td>
                        <td>{{ toEasternArabicNumerals($i + 1) }}</td>
                    </tr>
                @endfor

                <tr class="summary-row">
                    <td colspan="3">JUMLAH</td>
                    <td class="text-center">{{ $report->total_score }}</td>
                    <td class="font-italic"></td>
                    <td class="text-right" colspan="2"></td>
                    <td class="text-center">{{ toEasternArabicNumerals($report->total_score) }}</td>
                    <td class="text-right" colspan="6">مجموع النتائج</td>
                </tr>
                <tr class="summary-row">
                    <td colspan="3">RANGKING</td>
                    <td class="text-center">{{ $report->rank }}</td>
                    <td class="font-italic"></td>
                    <td class="text-right" colspan="2"></td>
                    <td class="text-center">{{ toEasternArabicNumerals($report->rank) }}</td>
                    <td class="text-right" colspan="6">الدرجة</td>
                </tr>

                <tr class="spacer-row">
                    <td colspan="15"></td>
                </tr>
                <tr>
                    <td class="section-header" colspan="5">KEPRIBADIAN</td>
                    <td class="vertical-divider" rowspan="4"></td>
                    <td class="section-header" colspan="3">ABSENSI</td>
                    <td class="section-header" colspan="6">كشف الغياب</td>
                </tr>
                <tr class="personality-row">
                    {{-- KEPRIBADIAN (5 columns) --}}
                    <td class="text-center">1</td>
                    <td colspan="2">السلوك (Behavior)</td>
                    <td colspan="1">:</td>
                    <td class="text-center">{{ $report->behavior }}</td>

                    {{-- ABSENSI (3 columns) --}}
                    <td>Sakit</td>
                    <td>:</td>
                    <td class="text-center">{{ $report->presence_sick ?? 0 }}</td>

                    {{-- كشف الغياب (6 columns) --}}
                    <td class="text-center">{{ toEasternArabicNumerals($report->presence_sick ?? 0) }}</td>
                    <td>:</td>
                    <td class="text-right align-bottom" colspan="4">بعذر</td>
                </tr>
                <tr class="personality-row">
                    {{-- KEPRIBADIAN (5 columns) --}}
                    <td class="text-center">2</td>
                    <td colspan="2">الترتيب (Orderly)</td>
                    <td colspan="1">:</td>
                    <td class="text-center">{{ $report->orderly }}</td>

                    {{-- ABSENSI (3 columns) --}}
                    <td colspan="1">Izin</td>
                    <td>:</td>
                    <td class="text-center">{{ $report->presence_permission ?? 0 }}</td>

                    {{-- كشف الغياب (6 columns) --}}
                    <td class="text-center">{{ toEasternArabicNumerals($report->presence_permission ?? 0) }}</td>
                    <td>:</td>
                    <td class="text-right align-bottom" colspan="4">بغير عذر</td>
                </tr>
                <tr class="personality-row">
                    {{-- KEPRIBADIAN (5 columns) --}}
                    <td class="text-center">3</td>
                    <td colspan="2">الا جتهاد (Perseverance)</td>
                    <td colspan="1">:</td>
                    <td class="text-center">{{ $report->perseverance }}</td>

                    {{-- ABSENSI (3 columns) --}}
                    <td>Alpa</td>
                    <td>:</td>
                    <td class="text-center">{{ $report->presence_absen ?? 0 }}</td>

                    {{-- كشف الغياب (6 columns) --}}
                    <td class="text-center">{{ toEasternArabicNumerals($report->presence_absen ?? 0) }}</td>
                    <td>:</td>
                    <td class="text-right align-bottom" colspan="4">بغير بيان</td>
                </tr>
                <tr class="invisible-spacer-row">
                    <td colspan="15" style="border:none;"></td>
                </tr>
                <tr class="notes-header">
                    <td colspan="15">Catatan Wali Kelas</td>
                </tr>
                <tr class="notes-content">
                    <td colspan="15">{{ $report->guardian_note }}</td>
                </tr>
                <tr class="notes-header">
                    <td colspan="15">Catatan Kepala Madrasah</td>
                </tr>
                <tr class="notes-content">
                    <td colspan="15">{{ $report->head_note }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Signature Section (Dinamis) -->
        <div class="signature-section">
            <div class="signature-box">
                <p>Mengetahui,</p>
                <p>Orang Tua / Wali</p>
                <p class="name">(..............................)</p>
            </div>
            <div class="signature-box">
                <p>Bojonegoro, {{ \Carbon\Carbon::parse($report->print_date)->translatedFormat('d F Y') }}</p>
                <p>Wali Kelas</p>
                <p class="name">({{ optional(optional($report->classroom)->teacher)->name ?? 'Nama Wali Kelas' }})
                </p>
            </div>
            <div class="signature-box">
                <p>Kepala Madrasah</p>
                <p>&nbsp;</p>
                <p class="name">({{ env('HEADMASTER_NAME', 'Nama Kepala Madrasah') }})</p>
            </div>
        </div>
    </div>
</body>

</html>
