<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <title>{{ $filename }}</title> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }

        .report-cover {
            width: 21.59cm;
            height: 32cm;
            background-color: #ffffff;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-sizing: border-box;
            background-image: url({{ asset('storage/bingkai.png') }});
            background-size: 100% 100%;
            background-repeat: no-repeat;
            padding: 110px 20px;
        }

        .content-wrapper {
            /* padding-top: 20px; */
            text-align: center;
            width: 100%;
        }

        .header-arabic {
            font-family: 'Amiri', serif;
            color: #000;
        }

        .header-arabic h1 {
            font-size: 52px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .header-arabic p {
            font-size: 26px;
            margin: 10px 0 0 0;
        }

        .logo-container {
            margin-top: 50px;
        }

        .logo {
            width: 200px;
            height: auto;
        }

        .divider-lines {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 7px;
        }

        .divider-line {
            width: 3px;
            margin-top: 20px;
            height: 180;
            background-color: #000;
        }

        .divider-line-a {
            width: 4px;
            height: 200px;
            background-color: #000;
        }

        .student-info {
            position: absolute;
            bottom: 130px;
            width: 350px;
            border: 2px solid #000000;
            border-radius: 20px;
            padding: 20px 40px;
            background-color: #eff1f3;
            box-shadow: 13px 14px 11px 5px #aaaaaa;
            direction: ltr;
            margin-bottom: 50px;

        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 18px;
            padding: 8px 0;
        }

        .info-row:first-of-type {
            border-bottom: 1px solid #ccc;
        }

        .info-label-ar {
            font-family: 'Amiri', serif;
            font-size: 16px;
            font-weight: bold;
        }

        .info-label-id {
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="report-cover">
        <div class="border-ornament">
            <div class="corner top-left"></div>
            <div class="corner top-right"></div>
            <div class="corner bottom-left"></div>
            <div class="corner bottom-right"></div>
        </div>

        <div class="content-wrapper">
            <div class="header-arabic">
                <h1>كشف الدرجات</h1>
                <p>للمدرسة الدينية دار البشير</p>
                <p>سنانغ فارهجا - بونوروغو - لامونجان</p>
            </div>

            <div class="logo-container">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo Darul Basyir" class="logo">
            </div>

            <div class="divider-lines">
                <div class="divider-line"></div>
                <div class="divider-line-a"></div>
                <div class="divider-line"></div>
            </div>
        </div>

        <div class="student-info">
            <div class="info-row">
                <span class="info-label-id">{{ $report->student->student_number }}</span>
                <span class="info-label-ar">: الرقم التسلسلي</span>
            </div>
            <div class="info-row">
                <span class="info-label-id">{{ $report->student->name }}</span>
                <span class="info-label-ar">: اسم الطالب/ ة</span>
            </div>
        </div>

    </div>

</body>

</html>
