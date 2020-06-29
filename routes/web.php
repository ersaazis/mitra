<?php

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

Route::get('/', function () {
    return cb()->redirect(cb()->getAdminPath('login'),'Silakan Login Terlebih Dahulu !','success');
});
Route::group([
    'middleware' => ['web', \ersaazis\cb\middlewares\CBBackend::class],
    'prefix' => cb()->getAdminPath(),
], function () {
    Route::get('/import/data/penjualan', 'AdminLaporanPenjualanAdminController@import');
    Route::post('/import/data/penjualan', 'AdminLaporanPenjualanAdminController@importSave');
});
Route::get('/{kodeunik}/kerjasama', 'LandingPageController@landingpage');
