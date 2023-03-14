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


//Auth::routes();
Route::middleware(['web', 'auth'])->group(function () {

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescriptions.upload');

Route::get('/prescriptions/upload', [App\Http\Controllers\PrescriptionController::class, 'create'])->name('prescriptions.upload');
Route::post('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'store'])->name('prescriptions.index');

Route::get('/prescriptions', [App\Http\Controllers\PrescriptionController::class, 'index'])->name('prescriptions.show');



Route::get('/prescriptions/{prescription}/quotations/create', [App\Http\Controllers\QuotationController::class, 'create'])->name('quotations.create');
Route::post('/prescriptions/{prescription}/quotations', [App\Http\Controllers\QuotationController::class, 'store'])->name('quotations.store');


Route::get('/prescriptions/{prescription}', [App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescriptions.show');
Route::get('/prescriptions/{prescription}/quotations', [App\Http\Controllers\PrescriptionController::class, 'show'])->name('prescriptions.quotations');
// Route::post('/prescriptions/{prescription}/quotations', 'App\Http\Controllers\QuotationController@store')->name('quotations.store');

Route::get('/quotations',  [App\Http\Controllers\QuotationController::class, 'index'])->name('quotations.index');

Route::post('/quotations/{id}/accept-reject', [App\Http\Controllers\QuotationController::class, 'acceptReject'])->name('quotations.acceptReject');


// Route::middleware(['auth', 'pharmacy'])->get('/prescriptions/{prescription}/quotations/create', [QuotationController::class, 'create'])->name('quotations.create');
});

// Authentication Routes
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
 Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
