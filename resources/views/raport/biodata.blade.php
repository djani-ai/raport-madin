<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biodata - {{ $record->student->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Amiri', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            /* min-height: 100vh; */
            margin: 0;
            /* padding: 20px 0; */
            direction: ltr;
        }

        .personal-data-sheet {
            width: 800px;
            min-height: 1131px;
            background-color: #ffffff;
            padding: 0px 80px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }

        .main-title {
            font-size: 56px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 60px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 4fr auto 1.5fr;
            font-size: 24px;
            row-gap: 25px;
            margin-bottom: 50px;
        }

        .info-grid .label {
            text-align: right;
            font-weight: bold;
        }

        .info-grid .colon {
            text-align: center;
            padding: 0 10px;
        }

        .info-grid .value {
            text-align: left;
            direction: ltr;
            font-family: 'Poppins', sans-serif;
            font-size: 22px
        }

        .footer-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: auto 0px;
        }

        .signature-area {
            text-align: center;
            font-size: 22px;
        }

        .signature-area .role {
            font-weight: bold;
            margin-bottom: 80px;
        }

        .signature-area .name {
            font-weight: bold;
            font-size: 24px;
            padding-bottom: 5px;
            border-bottom: 2px solid #000;
        }

        .photo-area {
            width: 142px;
            height: 213px;
            border: 2px solid #000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            color: #888;
        }
    </style>
</head>

<body>

    <div class="personal-data-sheet">
        <h1 class="main-title">القياد الشخصية</h1>

        <div class="info-grid">
            <div class="value">{{ $record->student->student_number }}</div>
            <div class="colon">:</div>
            <div class="label">رقم دفتر القيد</div>

            <div class="value">{{ $record->student->name }}</div>
            <div class="colon">:</div>
            <div class="label">اسم الطالبة</div>

            <div class="value">
                {{ $record->student->birth_place . ', ' . date('d M Y', strtotime($record->student->birth_date)) }}
            </div>
            <div class="colon">:</div>
            <div class="label">المولد</div>

            <div class="value">{{ $record->student->father_name }}</div>
            <div class="colon">:</div>
            <div class="label">اسم الولي</div>

            <div class="value">{{ $record->student->father_job }}</div>
            <div class="colon">:</div>
            <div class="label">الوظيفة</div>

            <div class="value">{{ $record->student->address }}</div>
            <div class="colon">:</div>
            <div class="label">محل الاقامة</div>
        </div>

        <div class="footer-section">
            <div class="signature-area">
                <p>سندانغ هارحو، ١٤ نوفمبر ٢٠٢٠</p>
                <p>المعتزف</p>
                <p class="role">مدير المعهد "دارالبشير"</p>
                <p class="name">الشيخ سعاد مهار</p>
            </div>
            <div class="photo-area">
                4x6
            </div>
        </div>

    </div>

</body>

</html>
