<?php

use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\QrScanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('registration/registration');
})->name('register');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/register', [ManufactureController::class, 'storeManufacturer'])->name('register.manufacturer');

Route::get('/qr-scan', [QrScanController::class, 'index'])->name('qrscan');
Route::post('/qr-scan', [QrScanController::class, 'store'])->name('qrscan.store');
