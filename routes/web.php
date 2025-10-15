<?php

use App\Http\Controllers\PdfController;
use App\Models\GenerateLeger;
use App\Models\Report;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateLegerController;
use App\Http\Controllers\LegerPdfController;

Route::get('/raport/{record}/preview', function (Report $record) {
    return view('raport/preview', ['record' => $record]);
})->name('raport.preview');
Route::get('/leger/{record}/preview', [GenerateLegerController::class, 'generateLeger'])
    ->name('leger.preview');

Route::get('/report/{report}/cetak', [PdfController::class, 'cetakRaport'])
    ->middleware('auth')
    ->name('report.cetak');
Route::get('/leger/{record}/cetak', [LegerPdfController::class, 'cetakLeger'])
    ->middleware('auth')
    ->name('leger.cetak');
