<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata Santri</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;600&display=swap');
        /* @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&family=Times+New+Roman&display=swap'); */

        body {
            font-family: 'Amiri', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            /* min-height: 100vh; */
            margin: 0;
            /* padding: 20px 0; */
        }

        .data-sheet {
            width: 800px;
            min-height: 1131px;
            background-color: #ffffff;
            /* border: 1px solid #999; */
            padding: 0px 80px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            font-size: 16px;
            /* Ukuran font dasar */
        }

        .main-title {
            font-family: 'Amiri', serif;
            /* Font khusus untuk judul Arab */
            font-size: 36px;
            font-weight: 700;
            text-align: center;
            margin: 0 0 10px 0;
        }

        .form-section {
            display: flex;
            flex-direction: column;
            gap: 5px;
            /* Jarak antar baris utama */
        }

        .form-row {
            display: flex;
            align-items: baseline;
            /* Menjaga teks tetap sejajar di garis bawah */
        }

        .form-row.sub-item {
            padding-left: 25px;
        }

        .form-row.sub-item .label {
            flex: 0 0 195px;

        }

        .form-row .num {
            flex: 0 0 25px;
            /* Lebar kolom nomor, tidak membesar/mengecil */
        }

        .form-row .label {
            flex: 0 0 220px;
            /* Lebar kolom label */
        }

        .form-row .colon {
            flex: 0 0 20px;
            /* Lebar kolom titik dua */
        }

        .form-row .value {
            flex: 1 1 auto;
            /* Kolom value akan mengisi sisa ruang */
            /* font-weight: bold; */
        }

        /* Memberi jarak atas untuk grup Diterima, Madrasah, dll. */
        .form-row.group-space {
            margin-top: 15px;
        }

        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            /* Mendorong footer ke bagian paling bawah */
            /* padding-top: 50px; */
        }

        .photo-box {
            width: 142px;
            /* 3 cm */
            height: 213px;
            /* 4 cm */
            border: 2px solid #000;
        }

        .signature-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Teks di tengah secara horizontal */
            text-align: center;
        }

        .date-location {
            align-self: flex-end;
            /* Membuat tanggal rata kanan dalam blok ttd */
            margin-bottom: 20px;
            font-size: 15px;
        }

        .role {
            margin-bottom: 80px;
            /* Jarak untuk tanda tangan */
        }

        .name {
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="data-sheet">
        <h1 class="main-title">القياد الشخصية</h1>

        <div class="form-section">
            <div class="form-row">
                <span class="num">1.</span>
                <span class="label">Nama Santri (Lengkap)</span>
                <span class="colon">:</span>
                <span class="value">{{ strtoupper($record->student->name) }}</span>
            </div>
            <div class="form-row">
                <span class="num">2.</span>
                <span class="label">Nomor Induk Santri</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->student_number }}</span>
            </div>
            <div class="form-row">
                <span class="num">3.</span>
                <span class="label">Jenis Kelamin</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->gender }}</span>
            </div>
            <div class="form-row">
                <span class="num">4.</span>
                <span class="label">Tempat & Tanggal Lahir</span>
                <span class="colon">:</span>
                <span
                    class="value">{{ $record->student->birth_place . ', ' . $record->student->birth_date->translatedFormat('d F Y') }}</span>
            </div>
            <div class="form-row">
                <span class="num">5.</span>
                <span class="label">Agama</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->religion }}</span>
            </div>
            <div class="form-row">
                <span class="num">6.</span>
                <span class="label">Anak Ke-</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->child_number }}</span>
            </div>
            <div class="form-row">
                <span class="num">7.</span>
                <span class="label">Status dalam Keluarga</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->family_status }}</span>
            </div>
            <div class="form-row">
                <span class="num">8.</span>
                <span class="label">Alamat Santri</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->address }}</span>
            </div>

            <div class="form-row group-space">
                <span class="num">9.</span>
                <span class="label">Diterima</span>
                <span class="colon"></span>
                <span class="value"></span>
            </div>
            <div class="form-row sub-item">
                <span class="num">a.</span>
                <span class="label">Di Kelas</span>
                <span class="colon">:</span>
                <span class="value"></span>
            </div>
            <div class="form-row sub-item">
                <span class="num">b</span>
                <span class="label">Pada Tanggal</span>
                <span class="colon">:</span>
                <span class="value"></span>
            </div>

            <div class="form-row group-space">
                <span class="num">10.</span>
                <span class="label">Madrasah/Sekolah Asal</span>
                <span class="colon"></span>
                <span class="value"></span>
            </div>
            <div class="form-row sub-item">
                <span class="num">a</span>
                <span class="label">Nama Madrasah/Sekolah</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->school_name }}</span>
            </div>
            <div class="form-row sub-item">
                <span class="num">b</span>
                <span class="label">Alamat</span>
                <span class="colon">:</span>
                <span class="value"></span>
            </div>

            <div class="form-row group-space">
                <span class="num">11.</span>
                <span class="label">Nama Orang Tua</span>
                <span class="colon"></span>
                <span class="value"></span>
            </div>
            <div class="form-row sub-item">
                <span class="num">a</span>
                <span class="label">Ayah</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->father_name }}</span>
            </div>
            <div class="form-row sub-item">
                <span class="num">b</span>
                <span class="label">Ibu</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->mother_name }}</span>
            </div>
            <div class="form-row sub-item">
                <span class="num"></span>
                <span class="label">Alamat Orang Tua</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->address }}</span>
            </div>
            <div class="form-row sub-item">
                <span class="num"></span>
                <span class="label">No. Handphone</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->parent_phone }}</span>
            </div>

            <div class="form-row group-space">
                <span class="num">12.</span>
                <span class="label">Pekerjaan Orang Tua</span>
                <span class="colon"></span>
                <span class="value"></span>
            </div>
            <div class="form-row sub-item">
                <span class="num">a</span>
                <span class="label">Ayah</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->father_job }}</span>
            </div>
            <div class="form-row sub-item">
                <span class="num">b</span>
                <span class="label">Ibu</span>
                <span class="colon">:</span>
                <span class="value">{{ $record->student->mother_job }}</span>
            </div>
        </div>

        <div class="footer-section">
            <div class="photo-box"></div>
            <div class="signature-area">
                <div class="date-location">سندانغ هارحو، 15 Maret 2023</div>
                <div class="role">
                    <p>Pengasuh</p>
                    <p>Pondok Pesantren DARUL BASYIR</p>
                </div>
                <div class="name">K.H. SUAT MUHAR, S.Pd</div>
            </div>
        </div>
    </div>

</body>

</html>
