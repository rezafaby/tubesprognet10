<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\IksController;
use App\Http\Controllers\PenjaminController;
use App\Http\Controllers\TipeIksController;
use App\Http\Controllers\KomponenGroupsController;
use App\Http\Controllers\KomponenGroupDetailController;
use App\Http\Controllers\TransaksiIKSProController;
use App\Http\Controllers\TransaksiKomIKSDetailController;
use App\Http\Controllers\TransaksiKomIKSController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\auth\AuthController as AuthAuthController;
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

Route::get('/',function(){
    return redirect('/iks');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginPost'])->name('auth.login.post');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});


Route::group(['middleware'=>'auth'], function(){

Route::get('/crud',[CrudController::class,'index'])->name('crud.list');
Route::get('/crud/create',[CrudController::class,'create'])->name('crud.create');
Route::get('/crud/{id}/edit',[CrudController::class,'edit'])->name('crud.edit');
Route::delete('/crud/{id}',[CrudController::class,'deleteData'])->name('crud.delete');
Route::post('/crud/listData',[CrudController::class,'listData'])->name('crud.listData');

Route::prefix('/tipeiks')->group(function(){
    Route::get('/',[TipeIksController::class,'index'])->name('tipeiks.index');
    Route::get('/create',[TipeIksController::class,'create'])->name('tipeiks.create');
    Route::post('/store',[TipeIksController::class,'store'])->name('tipeiks.store');
    Route::get('{id}/edit/',[TipeIksController::class,'edit'])->name('tipeiks.edit');
    Route::post('{id}/update',[TipeIksController::class,'update'])->name('tipeiks.update');
    Route::delete('/{id}',[TipeIksController::class,'deleteData'])->name('tipeiks.delete');
    Route::post('/tipeiks/listData',[TipeIksController::class,'listData'])->name('tipeiks.listData');
});

Route::prefix('/penjamin')->group(function(){
    Route::get('/',[PenjaminController::class,'index'])->name('penjamin.index');
    Route::get('/create',[PenjaminController::class,'create'])->name('penjamin.create');
    Route::post('/store',[PenjaminController::class,'store'])->name('penjamin.store');
    Route::get('{id}/edit/',[PenjaminController::class,'edit'])->name('penjamin.edit');
    Route::post('{id}/update',[PenjaminController::class,'update'])->name('penjamin.update');
    Route::delete('/{id}',[PenjaminController::class,'deleteData'])->name('penjamin.delete');
    Route::post('/penjamin/listData',[PenjaminController::class,'listData'])->name('penjamin.listData');
});

Route::prefix('/iks')->group(function(){
    Route::get('/',[IksController::class,'index'])->name('iks.index');
    Route::get('/create',[IksController::class,'create'])->name('iks.create');
    Route::post('/store',[IksController::class,'store'])->name('iks.store');
    Route::get('/edit/{id}',[IksController::class,'edit'])->name('iks.edit');
    Route::post('{id}/update',[IksController::class,'update'])->name('iks.update');
    Route::delete('/{id}',[IksController::class,'deleteData'])->name('iks.delete');
    Route::post('/listData',[IksController::class,'listData'])->name('iks.listData');
});

Route::prefix('/komponengroups')->group(function(){
    Route::get('/',[KomponenGroupsController::class,'index'])->name('komponengroups.index');
    Route::get('/create',[KomponenGroupsController::class,'create'])->name('komponengroups.create');
    Route::post('/store',[KomponenGroupsController::class,'store'])->name('komponengroups.store');
    Route::get('/{id}/edit',[KomponenGroupsController::class,'edit'])->name('komponengroups.edit');
    Route::post('/{id}/update',[KomponenGroupsController::class,'update'])->name('komponengroups.update');
    Route::delete('/{id}',[KomponenGroupsController::class,'deleteData'])->name('komponengroups.delete');
    Route::post('/listData',[KomponenGroupsController::class,'listData'])->name('komponengroups.listData');
});

Route::prefix('/komponengroupdetail')->group(function(){
    Route::get('index/{id?}',[KomponenGroupDetailController::class,'index'])->name('komponengroupdetail.index');
    Route::get('/',[KomponenGroupDetailController::class,'index'])->name('komponengroupdetail.index');
    Route::get('/create/{id}',[KomponenGroupDetailController::class,'createSpesific'])->name('komponengroupdetail.createSpesific');
    Route::get('/create',[KomponenGroupDetailController::class,'create'])->name('komponengroupdetail.create');
    Route::post('/store',[KomponenGroupDetailController::class,'store'])->name('komponengroupdetail.store');
    Route::get('/edit/{id}',[KomponenGroupDetailController::class,'edit'])->name('komponengroupdetail.edit');
    Route::post('/{id}/update',[KomponenGroupDetailController::class,'update'])->name('komponengroupdetail.update');
    Route::delete('/{id}',[KomponenGroupDetailController::class,'deleteData'])->name('komponengroupdetail.delete');
    Route::delete('/delete',[KomponenGroupDetailController::class,'deleteData'])->name('komponengroupdetail.delete');
    Route::post('/listData/{id?}',[KomponenGroupDetailController::class,'listData'])->name('komponengroupdetail.listData');
});

Route::prefix('/transaksiikspro')->group(function(){
    Route::get('/',[TransaksiIKSProController::class,'index'])->name('transaksiikspro.index');
    Route::get('/create',[TransaksiIKSProController::class,'create'])->name('transaksiikspro.create');
    Route::post('/store',[TransaksiIKSProController::class,'store'])->name('transaksiikspro.store');
    Route::get('/edit/{id}',[TransaksiIKSProController::class,'edit'])->name('transaksiikspro.edit');
    Route::post('/{id}/update',[TransaksiIKSProController::class,'update'])->name('transaksiikspro.update');
    Route::delete('/{id}',[TransaksiIKSProController::class,'deleteData'])->name('transaksiikspro.delete');
    Route::post('/listData',[TransaksiIKSProController::class,'listData'])->name('transaksiikspro.listData');
});

Route::prefix('/transaksikomiks')->group(function(){
    Route::get('/',[TransaksiKomIKSController::class,'index'])->name('transaksikomiks.index');
    Route::get('index/{id?}',[TransaksiKomIKSController::class,'index'])->name('transaksikomiks.index');
    Route::get('/create',[TransaksiKomIKSController::class,'create'])->name('transaksikomiks.create');
    Route::get('/create/{id}',[TransaksiKomIKSController::class,'createSpesific'])->name('transaksikomiks.createSpesific');
    Route::post('/store',[TransaksiKomIKSController::class,'store'])->name('transaksikomiks.store');
    Route::get('/edit/{id}',[TransaksiKomIKSController::class,'edit'])->name('transaksikomiks.edit');
    Route::post('/{id}/update',[TransaksiKomIKSController::class,'update'])->name('transaksikomiks.update');
    Route::delete('/{id}',[TransaksiKomIKSController::class,'deleteData'])->name('transaksikomiks.delete');
    // Route::post('/listData',[TransaksiKomIKSController::class,'listData'])->name('transaksikomiks.listData');
    Route::post('/listData/{id?}',[TransaksiKomIKSController::class,'listData'])->name('transaksikomiks.listData');
});


Route::prefix('/transaksikomiksdetail')->group(function(){
    Route::get('/',[TransaksiKomIKSDetailController::class,'index'])->name('transaksikomiksdetail.index');
    Route::get('index/{id?}',[TransaksiKomIKSDetailController::class,'index'])->name('transaksikomiksdetail.index');
    Route::get('/create',[TransaksiKomIKSDetailController::class,'create'])->name('transaksikomiksdetail.create');
    Route::get('/create/{id}',[TransaksiKomIKSDetailController::class,'createSpesific'])->name('transaksikomiksdetail.createSpesific');
    Route::post('/store',[TransaksiKomIKSDetailController::class,'store'])->name('transaksikomiksdetail.store');
    Route::get('/edit/{id}',[TransaksiKomIKSDetailController::class,'edit'])->name('transaksikomiksdetail.edit');
    Route::post('/{id}/update',[TransaksiKomIKSDetailController::class,'update'])->name('transaksikomiksdetail.update');
    Route::delete('/{id}',[TransaksiKomIKSDetailController::class,'deleteData'])->name('transaksikomiksdetail.delete');
    // Route::post('/listData',[TransaksiKomIKSDetailController::class,'listData'])->name('transaksikomiksdetail.listData');
    Route::post('/listData/{id?}',[TransaksiKomIKSDetailController::class,'listData'])->name('transaksikomiksdetail.listData');
});

Route::prefix('/pegawai')->group(function(){
    // Route::get('/',[PegawaiController::class,'index'])->name('transaksikomiksdetail.index');
    // Route::get('index/{id?}',[PegawaiController::class,'index'])->name('transaksikomiksdetail.index');
    Route::get('show',[PegawaiController::class,'show'])->name('pegawai.show');
    // Route::get('/show',[PegawaiController::class,'show'])->name('pegawai.show');
    // Route::get('/create',[PegawaiController::class,'create'])->name('transaksikomiksdetail.create');
    // Route::get('/create/{id}',[PegawaiController::class,'createSpesific'])->name('transaksikomiksdetail.createSpesific');
    // Route::post('/store',[PegawaiController::class,'store'])->name('transaksikomiksdetail.store');
    // Route::get('/edit/{id}',[PegawaiController::class,'edit'])->name('transaksikomiksdetail.edit');
    // Route::post('/{id}/update',[PegawaiController::class,'update'])->name('transaksikomiksdetail.update');
    // Route::delete('/{id}',[PegawaiController::class,'deleteData'])->name('transaksikomiksdetail.delete');
    // // Route::post('/listData',[PegawaiController::class,'listData'])->name('transaksikomiksdetail.listData');
    // Route::post('/listData/{id?}',[PegawaiController::class,'listData'])->name('pegawai.listData');
});

});