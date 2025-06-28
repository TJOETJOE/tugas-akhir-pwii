<?php
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);

//siswa
Route::get('/siswa', [SiswaController::class, 'index']);

Route::match(['get', 'post'], '/siswa/insert', [SiswaController::class, 'insert']);

Route::match(['get', 'post'], '/siswa/update/{id}', [SiswaController::class, 'update']);

Route::get('/siswa/delete/{id}', [SiswaController::class, 'delete']);

Route::get('/siswa/wali', [SiswaController::class, 'wali'])->name('siswa.wali');

Route::get('/siswa/wali/edit/{id}', [SiswaController::class, 'formWali'])->name('siswa.wali.edit');

Route::post('/siswa/wali/update/{id}', [SiswaController::class, 'storeWali'])->name('siswa.wali.update');

//Guru
Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');

Route::match(['get', 'post'], '/guru/insert', [GuruController::class, 'insert'])->name('guru.insert');

Route::match(['get', 'post'], '/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');

Route::get('/guru/delete/{id}', [GuruController::class, 'delete'])->name('guru.delete');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

//email
Route::get('/send-email', [SendEmailController::class, 'sendEmail']);

