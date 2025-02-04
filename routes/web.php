<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BikiluatController;
use App\Http\Controllers\ChucvuController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\KiluatController;
use App\Http\Controllers\NhansuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhongbanController;
use App\Http\Controllers\KhenthuongController;
use App\Models\Hopdong;
use App\Models\Khenthuong;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Http\Controllers\HopdongController;

use App\Http\Controllers\TangluongController;

use App\Http\Controllers\TrangthaiController;

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
    return view('auth.login');
});

Route::group(['middleware'=>'disable_back_btn'], function(){
    Route::middleware('auth')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/fetch-users', [UserController::class, 'fetchUser'])->name('users.fetch');
        Route::post('/check_email_unique', [UserController::class, 'check_email_unique'])->name('check_email_unique');
        Route::post('/check_account_unique', [UserController::class, 'check_account_unique'])->name('check_account_unique');
        Route::get('/check_email_edit', [UserController::class, 'check_email_edit'])->name('check_email_edit');
        Route::get('/check_account_edit', [UserController::class, 'check_account_edit'])->name('check_account_edit');
        Route::post('/check_current_password', [UserController::class, 'check_current_password'])->name('check_current_password');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/password', [PasswordController::class, 'edit'])->name('profile.change-pass');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('@deleteProfile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('khoas', KhoaController::class);
        Route::get('/fetch-khoas', [KhoaController::class, 'fetchKhoa'])->name('khoas.fetch');
        Route::get('/check_maKhoa_unique', [KhoaController::class, 'check_maKhoa_unique'])->name('check_maKhoa_unique');
        Route::post('/get-ten-khoa', [KhoaController::class, 'getTenKhoa'])->name('get-ten-khoa');

        Route::resource('chucvus', ChucvuController::class);
        Route::get('/fetch-chucvus', [ChucvuController::class, 'fetchChucvu'])->name('chucvus.fetch');
        Route::get('/check_maChucVu_unique', [ChucvuController::class, 'check_maChucVu_unique'])->name('check_maChucVu_unique');
        Route::post('/get-ten-chucvu', [ChucvuController::class, 'getTenChucvu'])->name('get-ten-chucvu');

        route::resource('phongbans',PhongbanController::class);
        Route::get('/fetch-phongbans', [PhongbanController::class, 'fetchPhongBan'])->name('phongbans.fetch');
        Route::get('/check_maPhongBan_unique', [PhongbanController::class, 'check_maPhongBan_unique'])->name('check_maPhongBan_unique');
        Route::get('/check_tenPhongBan_unique', [PhongbanController::class, 'check_tenPhongBan_unique'])->name('check_tenPhongBan_unique');
        Route::post('/get-ten-phongban', [PhongbanController::class, 'getTenPhongban'])->name('get-ten-phongban');

        Route::resource('nhansus', NhansuController::class);
        Route::get('/fetch-nhansus', [NhansuController::class, 'fetchNhansu'])->name('nhansus.fetch');
        Route::get('/nhansuNghihuu@{id}', [NhansuController::class, 'nghiHuu'])->name('nhansus@nghihuu');
        Route::get('/nhansu_Nghihuu', [NhansuController::class, 'nhansuNghihuu'])->name('nhansu_Nghihuu');
        Route::get('/fetch-nhansuNghihuus', [NhansuController::class, 'fetchNhansuNghihuu'])->name('nhansuNghihuus.fetch');
        Route::get('/showNhansusnghihuu', [NhansuController::class, 'showNhanSuNghiHuu'])->name('showNhansusnghihuu');
        Route::get('/delete_Nhansu_Nghihuu#{id}', [NhansuController::class, 'deleteNhansuNghihuu'])->name('delete_Nhansu_Nghihuu');
        Route::get('/filter', [NhansuController::class, 'filter'])->name('nhansus.filter');
        Route::post('/get-ten-nhansu', [NhansuController::class, 'getTenNhanSu'])->name('get-ten-nhansu');

        Route::resource('hopdongs', HopdongController::class);
        Route::get('/fetch-hopdongs', [HopdongController::class, 'fetchHopdong'])->name('hopdongs.fetch');
        Route::post('/get-ten-hopdong', [HopdongController::class, 'getTenHopdong'])->name('get-ten-hopdong');
        Route::get('/check_maHopdong_unique', [HopdongController::class, 'check_maHopdong_unique'])->name('check_maHopdong_unique');


        Route::resource('khenthuongs', KhenthuongController::class);
        Route::get('/fetch-khenthuongs', [KhenthuongController::class, 'fetchKhenthuong'])->name('khenthuongs.fetch');
        Route::get('/get_Manhansu_list', [KhenThuongController::class, 'getManhansuList'])->name('get_Manhansu_list');
        Route::get('/check_Manhansu_exists', [KhenThuongController::class, 'getManhansuExists'])->name('check_Manhansu_exists');

        Route::resource('kiluats', KiluatController::class);
        Route::get('/fetch-kiluats', [KiluatController::class, 'fetchKiLuat'])->name('kiluats.fetch');
        Route::get('/check_maKiLuat_unique', [KiluatController::class, 'check_maKiLuat_unique'])->name('check_maKiLuat_unique');
        Route::get('/check_tenKiLuat_unique', [KiluatController::class, 'check_tenKiLuat_unique'])->name('check_tenKiLuat_unique');

        Route::resource('tangluongs', TangluongController::class);
        Route::get('/fetch-tangluongs', [TangluongController::class, 'fetchTangLuong'])->name('tangluongs.fetch');
        Route::get('/check_maTangLuong_unique', [TangluongController::class, 'check_maTangLuong_unique'])->name('check_maTangLuong_unique');

        Route::resource('trangthais', TrangthaiController::class);
        Route::get('/fetch-trangthais', [TrangthaiController::class, 'fetchTrangthai'])->name('trangthais.fetch');
        Route::get('/check_maTrangThai_unique', [TrangthaiController::class, 'check_maTrangThai_unique'])->name('check_maTrangThai_unique');
        Route::get('/check_tenTrangThai_unique', [TrangthaiController::class, 'check_tenTrangThai_unique'])->name('check_tenTrangThai_unique');
        Route::post('/get-ten-trangthai', [TrangthaiController::class, 'getTenTrangthai'])->name('get-ten-trangthai');


        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
