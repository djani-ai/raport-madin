<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReportViewController;
use App\Models\ClassroomStudent;
use App\Models\Report;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/raport/{record}/preview', function (Report $record) {
    return view('raport/preview', ['record' => $record]);
})->name('raport.preview'); // Beri nama route agar mudah dipanggil
