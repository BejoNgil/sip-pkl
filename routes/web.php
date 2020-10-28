<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'can:admin'], function () {
        Route::resource('peserta', 'PesertaController', ['parameters' => ['peserta' => 'peserta']]);
        Route::patch('peserta-reset-password/{peserta}', 'PesertaController@resetPassword')->name('peserta.reset-password');
        Route::resource('admin', 'AdminController')->except(['create', 'edit', 'show']);
        Route::resource('pembimbing', 'PembimbingController')->except(['create', 'edit', 'show']);
        Route::resource('sekolah', 'SekolahController')->except(['create', 'edit', 'show']);
        Route::resource('penilaian/kategori', 'KategoriPenilaianController')->except(['create', 'edit', 'show']);
        Route::resource('program-keahlian', 'ProgramKeahlianController')->except(['create', 'edit', 'show']);
        Route::resource('posisi', 'PosisiController')->except(['create', 'edit', 'show']);
        Route::get('profil', 'ProfilController@index')->name('admin.profile');
        Route::put('profil', 'ProfilController@update');
    });

    Route::group(['namespace' => 'Pembimbing', 'prefix' => 'pembimbing', 'middleware' => 'can:pembimbing'], function () {
        Route::resource('bimbingan', 'BimbinganController')->names('kelola-bimbingan')->only(['index', 'update']);
        Route::get('bimbingan', 'BimbinganController@index')->name('kelola-bimbingan.index');
        Route::put('bimbingan/{bimbingan}', 'BimbinganController@approve')->name('kelola-bimbingan.approve');
        Route::get('permasalahan-kerja', 'PermasalahanKerjaController@index')->name('kelola-masalah.index');
        Route::put('permasalahan-kerja/{permasalahanKerja}', 'PermasalahanKerjaController@update')->name('kelola-masalah.update');
        Route::get('nilai', 'PenilaianController@index')->name('kelola-nilai.index');
        Route::post('nilai/{pkl}', 'PenilaianController@assignNilai')->name('kelola-nilai.assign-nilai');
        Route::get('profil', 'ProfilController@index')->name('pembimbing.profile');
        Route::put('profil', 'ProfilController@update');
    });

    Route::group(['namespace' => 'Peserta', 'prefix' => 'peserta', 'middleware' => ['can:peserta']], function () {
        Route::get('profil', 'ProfilController@index')->name('peserta.profile');
        Route::put('profil', 'ProfilController@update');

        Route::middleware('hasPKL')->group(function () {
            Route::resource('kegiatan', 'LogKegiatanController')->only(['index', 'store', 'update', 'destroy']);
            Route::resource('permasalahan-kerja', 'PermasalahanKerjaController')->only(['index', 'store', 'update', 'destroy']);
            Route::resource('bimbingan', 'BimbinganController')->only(['index', 'store', 'update', 'destroy']);
            Route::get('absensi', 'AbsensiController@index')->name('absensi.index');
            Route::post('absensi', 'AbsensiController@store')->name('absensi.store');
            Route::get('download-surat/{pkl}', 'PrintSuratController')->name('download.surat');
            Route::get('nilai', 'PenilaianController@index')->name('nilai.index');
        });
    });

    Route::group(['namespace' => 'Manage', 'prefix' => 'manage', 'middleware' => ['can:admin' || 'can:pembimbing']], function () {
        Route::resource('pkl', 'ManagePKLController');
    });

    Route::group(['namespace' => 'Resource', 'prefix' => 'resource', 'middleware' => ['can:admin' || 'can:pembimbing']], function () {
        Route::get('peserta', 'PesertaController')->name('resource.peserta');
        Route::get('peserta/{peserta}', 'PesertaController@show')->name('resource.peserta.show');
        Route::get('pembimbing', 'PembimbingController')->name('resource.pembimbing');
        Route::get('posisi', 'PosisiController')->name('resource.posisi');
    });

    Route::post('change-password', 'ChangePasswordController')->name('change.password');
    Route::view('peserta/forbidden', 'peserta.doesnt-have-pkl')->middleware('can:peserta')->name('peserta.forbidden');
});