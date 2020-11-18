<?php

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/pendaftaran', 'PendaftaranController@index')->name('pendaftaran.index');
Route::get('/pendaftaran/success', 'PendaftaranController@success')->name('pendaftaran.success');
Route::post('/pendaftaran', 'PendaftaranController@store')->name('pendaftaran.store');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'can:admin'], function () {
        Route::get('/peserta/test-email', 'PesertaController@testEmail')->name('peserta.test-email');
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
        Route::get('/laporan-pkl', 'ReportController@index')->name('laporan-pkl.index');
        Route::post('/laporan-pdf', 'ReportController@exportPdf')->name('laporan-pkl.pdf');
    });

    Route::group(['namespace' => 'Pembimbing', 'prefix' => 'pembimbing', 'middleware' => 'can:pembimbing'], function () {
        Route::resource('bimbingan', 'BimbinganController')->names('kelola-bimbingan')->only(['index', 'update']);
        Route::get('bimbingan', 'BimbinganController@index')->name('kelola-bimbingan.index');
        Route::get('bimbingan/{bimbingan}', 'BimbinganController@show')->name('kelola-bimbingan.show');
        Route::put('bimbingan/{bimbingan}', 'BimbinganController@approve')->name('kelola-bimbingan.approve');
        Route::get('permasalahan-kerja', 'PermasalahanKerjaController@index')->name('kelola-masalah.index');
        Route::get('permasalahan-kerja/{masalah_kerja}', 'PermasalahanKerjaController@show')->name('kelola-masalah.show');
        Route::post('permasalahan-kerja/{masalah_kerja}', 'PermasalahanKerjaController@detailMasalah')->name('kelola-masalah-kerja.post');
        Route::put('permasalahan-kerja/{permasalahanKerja}', 'PermasalahanKerjaController@update')->name('kelola-masalah.update');
        Route::get('nilai', 'PenilaianController@index')->name('kelola-nilai.index');
        Route::post('nilai/{pkl}', 'PenilaianController@assignNilai')->name('kelola-nilai.assign-nilai');
        Route::get('profil', 'ProfilController@index')->name('pembimbing.profile');
        Route::put('profil', 'ProfilController@update');
    });

    Route::group(['namespace' => 'Peserta', 'prefix' => 'peserta', 'middleware' => ['can:peserta']], function () {
        Route::get('/confirmation', 'ProfilController@confirmation')->name('peserta.confirmation');
        Route::get('profil', 'ProfilController@index')->name('peserta.profile');
        Route::put('profil', 'ProfilController@update');

        Route::middleware('hasPKL')->group(function () {
            Route::resource('kegiatan', 'LogKegiatanController')->only(['index', 'store', 'update', 'destroy']);
            Route::post('detail-permasalahan-kerja/{masalah_kerja}', 'PermasalahanKerjaController@detailMasalah')->name('detail-masalah-kerja.post');
            Route::post('detail-permasalahan-close/{masalah_kerja}', 'PermasalahanKerjaController@close')->name('detail-masalah-kerja.close');
            Route::resource('permasalahan-kerja', 'PermasalahanKerjaController')->only(['index', 'store', 'update', 'destroy', 'show']);
            Route::resource('bimbingan', 'BimbinganController')->only(['index', 'store', 'update', 'destroy']);
            Route::get('absensi', 'AbsensiController@index')->name('absensi.index');
            Route::post('absensi', 'AbsensiController@store')->name('absensi.store');
            Route::get('download-surat/{pkl}', 'PrintSuratController')->name('download.surat');
            Route::get('nilai', 'PenilaianController@index')->name('nilai.index');
        });
    });

    Route::group(['namespace' => 'Manage', 'prefix' => 'manage', 'middleware' => ['can:admin' || 'can:pembimbing']], function () {
        Route::get('pkl', 'ManagePKLController@index')->name('pkl.index');
        Route::post('pkl', 'ManagePKLController@store')->name('pkl.store');
        Route::get('jobdesc/{pkl}', 'ManagePKLController@showJobdesc')->name('resource.jobdesc.show');
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
