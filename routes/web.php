<?php

use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */

Route::get('/', [App\Http\Controllers\LandingController::class , 'index']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('/user')->group(function () {
    Route::get('/', [App\Http\Controllers\UserController::class , 'index'])->name('user.index');
    Route::post('/update', [App\Http\Controllers\UserController::class , 'updateuser'])->name('user.update');
});

// Route::middleware('role:admin')->group(function () {
Route::prefix('/admin')->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class , 'indexadmin'])->name('home.admin');
    Route::prefix('/monev')->group(function () {
            Route::get('/', [App\Http\Controllers\MonevController::class , 'index'])->name('admin.monev.index');
            Route::post('/store', [App\Http\Controllers\MonevController::class , 'store'])->name('admin.monev.store');
            Route::post('/storefoto', [App\Http\Controllers\MonevController::class , 'storefoto'])->name('admin.monev.storefoto');
            Route::post('/storefile', [App\Http\Controllers\MonevController::class , 'storefile'])->name('admin.monev.storefile');
            Route::post('/storerealisasi', [App\Http\Controllers\MonevController::class , 'storerealisasi'])->name('admin.monev.storerealisasi');
            Route::post('/updaterealisasi', [App\Http\Controllers\MonevController::class , 'updaterealisasi'])->name('admin.monev.updaterealisasi');
            Route::post('/update', [App\Http\Controllers\MonevController::class , 'update'])->name('admin.monev.update');
            Route::post('/show', [App\Http\Controllers\MonevController::class , 'showrealisasi'])->name('admin.monev.show');
            Route::post('/showfile', [App\Http\Controllers\MonevController::class , 'showfile'])->name('admin.monev.showfile');
            Route::post('/showedit', [App\Http\Controllers\MonevController::class , 'showrealisasiedit'])->name('admin.monev.showedit');
            Route::get('/detail/{id}', [App\Http\Controllers\MonevController::class , 'detail'])->name('admin.monev.detail');
            Route::get('/detailfoto/{id}', [App\Http\Controllers\MonevController::class , 'detailfoto'])->name('admin.monev.detailfoto');
            Route::get('/add/{id}', [App\Http\Controllers\MonevController::class , 'add'])->name('admin.monev.add');
            Route::get('/edit/{id}', [App\Http\Controllers\MonevController::class , 'edit'])->name('admin.monev.edit');
            Route::post('/delete', [App\Http\Controllers\MonevController::class , 'delete'])->name('admin.monev.delete');
            Route::post('/deletefoto', [App\Http\Controllers\MonevController::class , 'deletefoto'])->name('admin.monev.deletefoto');
            Route::post('/deletefile', [App\Http\Controllers\MonevController::class , 'deletefile'])->name('admin.monev.deletefile');
            Route::post('/deleterealisasi', [App\Http\Controllers\MonevController::class , 'deleterealisasi'])->name('admin.monev.deleterealisasi');
            Route::any('/marker', [App\Http\Controllers\MonevController::class , 'marker'])->name('admin.monev.marker');
        }
        );

        Route::prefix('/pengawasan')->group(function () {
            Route::get('/', [App\Http\Controllers\PengawasanController::class , 'index'])->name('admin.monev.pengawasan.index');
            Route::post('/store', [App\Http\Controllers\PengawasanController::class , 'store'])->name('admin.monev.pengawasan.store');
            Route::post('/storefoto', [App\Http\Controllers\PengawasanController::class , 'storefoto'])->name('admin.monev.pengawasan.storefoto');
            Route::post('/storefile', [App\Http\Controllers\PengawasanController::class , 'storefile'])->name('admin.monev.pengawasan.storefile');
            Route::post('/storerealisasi', [App\Http\Controllers\PengawasanController::class , 'storerealisasi'])->name('admin.monev.pengawasan.storerealisasi');
            Route::post('/updaterealisasi', [App\Http\Controllers\PengawasanController::class , 'updaterealisasi'])->name('admin.monev.pengawasan.updaterealisasi');
            Route::post('/update', [App\Http\Controllers\PengawasanController::class , 'update'])->name('admin.monev.pengawasan.update');
            Route::post('/show', [App\Http\Controllers\PengawasanController::class , 'showrealisasi'])->name('admin.monev.pengawasan.show');
            Route::post('/showfile', [App\Http\Controllers\PengawasanController::class , 'showfile'])->name('admin.monev.pengawasan.showfile');
            Route::post('/showedit', [App\Http\Controllers\PengawasanController::class , 'showrealisasiedit'])->name('admin.monev.pengawasan.showedit');
            Route::get('/detail/{id}', [App\Http\Controllers\PengawasanController::class , 'detail'])->name('admin.monev.pengawasan.detail');
            Route::get('/detailfoto/{id}', [App\Http\Controllers\PengawasanController::class , 'detailfoto'])->name('admin.monev.pengawasan.detailfoto');
            Route::get('/add/{id}', [App\Http\Controllers\PengawasanController::class , 'add'])->name('admin.monev.pengawasan.add');
            Route::get('/edit/{id}', [App\Http\Controllers\PengawasanController::class , 'edit'])->name('admin.monev.pengawasan.edit');
            Route::post('/delete', [App\Http\Controllers\PengawasanController::class , 'delete'])->name('admin.monev.pengawasan.delete');
            Route::post('/deletefoto', [App\Http\Controllers\PengawasanController::class , 'deletefoto'])->name('admin.monev.pengawasan.deletefoto');
            Route::post('/deletefile', [App\Http\Controllers\PengawasanController::class , 'deletefile'])->name('admin.monev.pengawasan.deletefile');
            Route::post('/deleterealisasi', [App\Http\Controllers\PengawasanController::class , 'deleterealisasi'])->name('admin.monev.pengawasan.deleterealisasi');
            Route::any('/marker', [App\Http\Controllers\PengawasanController::class , 'marker'])->name('admin.monev.pengawasan.marker');
        }
        );

        Route::prefix('/table')->group(function () {
            Route::get('/', [App\Http\Controllers\MonevController::class , 'indextable'])->name('admin.monev.table.index');
            Route::get('/data', [App\Http\Controllers\MonevController::class , 'data'])->name('admin.monev.table.data');
        }
        );



        //Rekapitulasi
        Route::prefix('/k01a')->group(function () {
            Route::get('/', [App\Http\Controllers\RekapitulasiController::class , 'k01a'])->name('admin.monev.k01a.index');
        }
        );
        Route::prefix('/k01b')->group(function () {
            Route::get('/', [App\Http\Controllers\RekapitulasiController::class , 'k01b'])->name('admin.monev.k01b.index');
        });
        Route::prefix('/k02')->group(function () {
            Route::get('/', [App\Http\Controllers\MonevController::class , 'k02'])->name('admin.monev.k02.index');
            Route::post('/insertDatak02', [App\Http\Controllers\MonevController::class , 'insertDatak02'])->name('admin.monev.k02.insert');
            Route::put('/updatek02', [App\Http\Controllers\MonevController::class, 'updatek02'])->name('admin.monev.k02.update');
            Route::put('/updatek02bawah', [App\Http\Controllers\MonevController::class, 'updatek02bawah'])->name('admin.monev.k02.updatebawah');
            Route::delete('/admin/monev/k02/{id}', [App\Http\Controllers\MonevController::class, 'destroyk02'])->name('admin.monev.k02.destroy');
            Route::get('/downloadk02/{anggaran}', [App\Http\Controllers\MonevController::class, 'downloadk02'])->name('admin.monev.k02.download');
        }
        );
        
        Route::prefix('/k03')->group(function () {
            Route::get('/', [App\Http\Controllers\MonevController::class , 'k03'])->name('admin.monev.k03.index');
        }
        );

        Route::prefix('/k04')->group(function () {
            Route::get('/', [App\Http\Controllers\MonevController::class , 'k04'])->name('admin.monev.k04.index');

        }
        );

        Route::get('/under-construction', function () {
            return view('admin.monev.under_construction.index');
        }
        )->name('under_construction');


    }
);

Route::prefix('/master')->group(function () {
    Route::prefix('/data')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'data'])->name('master.data');
            Route::get('/show', [App\Http\Controllers\MasterController::class , 'showdata'])->name('master.show');
            Route::post('/delete', [App\Http\Controllers\MasterController::class , 'deletedata'])->name('master.delete');
        }
        );
        Route::prefix('/skpd')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexskpd'])->name('skpd.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storeskpd'])->name('skpd.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updateskpd'])->name('skpd.update');
        }
        );

        Route::prefix('/user')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexuser'])->name('master.user.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storeuser'])->name('master.user.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updateuser'])->name('master.user.update');
        }
        );

        Route::prefix('/urusan')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexurusan'])->name('urusan.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storeurusan'])->name('urusan.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updateurusan'])->name('urusan.update');
        }
        );

        Route::prefix('/bidang')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexbidang'])->name('bidang.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storebidang'])->name('bidang.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updatebidang'])->name('bidang.update');
        }
        );

        Route::prefix('/program')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexprogram'])->name('program.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storeprogram'])->name('program.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updateprogram'])->name('program.update');
        }
        );

        Route::prefix('/kegiatan')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexkegiatan'])->name('kegiatan.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storekegiatan'])->name('kegiatan.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updatekegiatan'])->name('kegiatan.update');
        }
        );

        Route::prefix('/sub')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexsub'])->name('sub.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storesub'])->name('sub.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updatesub'])->name('sub.update');
        }
        );

        Route::prefix('/nomen')->group(function () {
            Route::get('/', [App\Http\Controllers\MasterController::class , 'indexnomen'])->name('nomen.index');
            Route::post('/store', [App\Http\Controllers\MasterController::class , 'storenomen'])->name('nomen.store');
            Route::post('/update', [App\Http\Controllers\MasterController::class , 'updatenomen'])->name('nomen.update');
            Route::any('/urusan', [App\Http\Controllers\MasterController::class , 'urusan'])->name('nomen.urusan');
            Route::any('/bidang', [App\Http\Controllers\MasterController::class , 'bidang'])->name('nomen.bidang');
            Route::any('/program', [App\Http\Controllers\MasterController::class , 'program'])->name('nomen.program');
            Route::any('/kegiatan', [App\Http\Controllers\MasterController::class , 'kegiatan'])->name('nomen.kegiatan');
            Route::any('/sub', [App\Http\Controllers\MasterController::class , 'sub'])->name('nomen.sub');
            Route::any('/bidang_filter', [App\Http\Controllers\MasterController::class , 'bidang_filter'])->name('nomen.filter.bidang');
            Route::any('/program_filter', [App\Http\Controllers\MasterController::class , 'program_filter'])->name('nomen.filter.program');
            Route::any('/kegiatan_filter', [App\Http\Controllers\MasterController::class , 'kegiatan_filter'])->name('nomen.filter.kegiatan');
            Route::any('/sub_filter', [App\Http\Controllers\MasterController::class , 'sub_filter'])->name('nomen.filter.sub');
        }
        );
    }
);

Route::prefix('/excel')->group(function () {
    Route::prefix('/rutin')->group(function () {
            Route::get('/', [App\Http\Controllers\ExcelController::class , 'rutin'])->name('excel.rutin');
        }
        );
        Route::prefix('/teknis')->group(function () {
            Route::get('/', [App\Http\Controllers\ExcelController::class , 'teknis'])->name('excel.teknis');
        }
        );
    }
);
// });

Route::middleware('role:skpd')->group(function () {
    Route::prefix('/skpd')->group(function () {
            Route::get('home', [App\Http\Controllers\HomeController::class , 'indexskpd'])->name('home.skpd');

            Route::prefix('/spbe')->group(function () {
                    Route::get('/', [App\Http\Controllers\TrxJawabanController::class , 'indexspbe'])->name('spbe.index');
                    Route::post('/store', [App\Http\Controllers\TrxJawabanController::class , 'storespbe'])->name('spbe.store');
                    Route::post('/update', [App\Http\Controllers\TrxJawabanController::class , 'updatespbeskpd'])->name('spbe.update');
                    Route::post('/add', [App\Http\Controllers\TrxJawabanController::class , 'addspbe'])->name('spbe.add');
                    Route::post('/detail', [App\Http\Controllers\TrxJawabanController::class , 'detailspbe'])->name('spbe.detail');
                    Route::post('/delete', [App\Http\Controllers\TrxJawabanController::class , 'deletespbe'])->name('spbe.delete');
                    Route::post('/deleteupload', [App\Http\Controllers\TrxJawabanController::class , 'deleteupload'])->name('spbe.deleteupload');
                    Route::post('/verif', [App\Http\Controllers\TrxJawabanController::class , 'verifspbeskpd'])->name('spbe.verif');
                }
                );
            }
            );
        });

Route::any('logout', [App\Http\Controllers\Auth\LoginController::class , 'logout'])->name('logout');
