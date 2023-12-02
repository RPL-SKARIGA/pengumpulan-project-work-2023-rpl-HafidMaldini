<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\jawabanController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\tawabController;
use Faker\Guesser\Name;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [tawabController::class, 'index'])->middleware('auth')->name('index');
Route::get('/login', [AuthController::class, 'Index'])->name('login');
Route::post('/prosesLogin', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::resource('Index', tawabController::class);
Route::resource('pertanyaan', tawabController::class);

Route::get('/pertanyaan/{id}', [tawabController::class, 'show'])->name('show');
Route::get('tawab/pertanyaan/{id}', [tawabController::class, 'show2'])->name('show2');
Route::get('history/pertanyaan/{id}', [tawabController::class, 'show3'])->name('show3');

Route::get('/search', [tawabController::class, 'search'])->name('search');
Route::get('/history', [tawabController::class, 'history'])->name('history');


Route::post('/edit-jawaban', [jawabanController::class ,'edit']);
Route::get('/index/create', [tawabController::class, 'create']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/jawaban', [jawabanController::class, 'store'])->name('jawaban.store');
Route::post('history/jawaban/{id}', [jawabanController::class, 'destroy2'])->name('jawaban.destroy2');
// Route::post('/jawaban/{id}', [jawabanController::class, 'destroy2'])->name('jawaban.destroy2');
Route::get('/pertanyaans/{pertanyaan}/like', [LikeController::class, 'likePertanyaan'])->name('like.pertanyaan');
Route::get('/pertanyaans/{pertanyaan}/unlike', [LikeController::class, 'unlikePertanyaan'])->name('unlike.pertanyaan');
Route::get('/jawabans/{jawaban}/like', [LikeController::class, 'likeJawaban'])->name('like.jawaban');
Route::get('/jawabans/{jawaban}/unlike', [LikeController::class, 'unlikeJawaban'])->name('unlike.jawaban');
Route::post('/prosesLoginAdmin', [AdminAuthController::class, 'login']);
// Route::resource('index', AdminController::class);
Route::get('Admin/login', [AdminAuthController::class, 'index'])->name('loginAdmin');
Route::get('Admin/index', [AdminController::class, 'index'])->name('adminDashboard');
Route::post('Admin/Store', [AdminController::class, 'store'])->name('Admin.store');
Route::get('Admin/user', [AdminController::class, 'user'])->name('listUser');
Route::get('Admin/pertanyaan', [AdminController::class, 'pertanyaan'])->name('listPertanyaan');
Route::get('Admin/jawaban', [AdminController::class, 'jawaban'])->name('listJawaban');
Route::post('user/destroy', [AdminController::class, 'userDestroy'])->name('user.destroy');
Route::post('/pertanyaan/{id}', [AdminController::class, 'pertanyaanDestroy'])->name('pertanyaan.destroy');
Route::post('/jawaban/{id}', [AdminController::class, 'jawabanDestroy'])->name('jawaban.destroy');
Route::post('/laporan', [reportController::class, 'store'])->name('laporan.store');
Route::get('/report/report/{id}', [reportController::class, 'report'])->name('report');
Route::get('Admin/report', [AdminController::class, 'report'])->name('listLaporan');
Route::post('/report/{id}', [AdminController::class, 'laporanDestroy'])->name('laporan.destroy');
Route::get('Admin/report/{id}', [AdminController::class, 'detailLaporan'])->name('report.detail');
Route::get('Admin/detailPertanyaan/{id}', [AdminController::class, 'detailPertanyaan'])->name('pertanyaan.detail');
Route::post('Admin/pertanyaan/{id}', [AdminController::class, 'pertanyaanDestroy2'])->name('pertanyaan.destroy2');
Route::get('index/matematika', [tawabController::class, 'matematika'])->name('matematika');
Route::get('index/Bindonesia', [tawabController::class, 'Bindonesia'])->name('Bindonesia');
Route::get('index/Binggris', [tawabController::class, 'Binggris'])->name('Binggris');
Route::get('index/Bdaerah', [tawabController::class, 'Bdaerah'])->name('Bdaerah');
Route::get('index/agama', [tawabController::class, 'agama'])->name('agama');
Route::get('index/IPA', [tawabController::class, 'IPA'])->name('IPA');
Route::get('index/sbudaya', [tawabController::class, 'sbudaya'])->name('sbudaya');
Route::get('index/IPS', [tawabController::class, 'IPS'])->name('IPS');
Route::get('index/PPKN', [tawabController::class, 'PPKN'])->name('PPKN');
Route::get('index/PJOK', [tawabController::class, 'PJOK'])->name('PJOK');
Route::get('index/sejarah', [tawabController::class, 'sejarah'])->name('sejarah');
Route::post('user/pertanyaan/{id}', [tawabController::class, 'pertanyaanDestroy'])->name('pertanyaan.destroy3');