<?php

use App\Http\Controllers\CoverPdfController;
use App\Http\Controllers\PdfController;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateLegerController;
use App\Http\Controllers\LegerPdfController;
use Illuminate\Routing\RouteGroup;


Route::middleware(['auth'])->group(function () {

    Route::get('/leger/cetak/{record}', [LegerPdfController::class, 'cetakLeger'])
        ->name('leger.cetak');
    Route::get('/report/cover/{report}', [CoverPdfController::class, 'cetakCover'])
        ->name('report.cover');
    Route::get('/report/cetak/{report}', [PdfController::class, 'cetakRaport'])
        ->name('report.cetak');
    Route::get('/report/biodata/{report}', [PdfController::class, 'cetakBiodata'])
        ->name('report.biodata');
    Route::get('/report/biodata2/{report}', [PdfController::class, 'cetakBiodata2'])
        ->name('report.biodata2');

    Route::get('/report/preview/{record}', function (Report $record) {
        return view('raport/preview', ['record' => $record]);
    })->name('raport.preview');
    Route::get('/report/cover-preview/{record}', function (Report $record) {
        return view('raport/cover', ['report' => $record]);
    })->name('report.cover.preview');
    Route::get('/report/biodata-preview/{record}', function (Report $record) {
        return view('raport/biodata', ['record' => $record]);
    })->name('report.biodata.preview');
    Route::get('/report/biodata2-preview/{record}', function (Report $record) {
        return view('raport/biodata2', ['record' => $record]);
    })->name('report.biodata2.preview');
});
