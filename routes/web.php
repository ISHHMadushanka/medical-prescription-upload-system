<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescriptions.upload');

Route::get('/prescriptions/upload', [App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescription.create');
Route::post('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescription.store');

Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('prescription.index');



Route::get('/prescriptions/{prescription}/quotations/create', [App\Http\Controllers\QuotationController::class, 'create'])->name('quotations.create');
Route::post('/prescriptions/{prescription}/quotations', [App\Http\Controllers\QuotationController::class, 'store'])->name('quotations.store');


//Route::get('/prescriptions/{prescription}/quotations/create', [App\Http\Controllers\QuotationController::class, 'create'])->name('quotations.create');
// // Route::get('/prescriptions/{prescription}/quotations', 'PrescriptionController@showQuotationsForm')->name('prescriptions.quotations');
// Route::post('/prescriptions/{prescription}/quotations', 'App\Http\Controllers\QuotationController@store')->name('quotations.store');


// Route::middleware(['auth', 'pharmacy'])->get('/prescriptions/{prescription}/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
