<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\IksController;
use App\Http\Controllers\PenjaminController;
use App\Http\Controllers\KomponenGroupsController;
use App\Http\Controllers\KomponenGroupDetailController;
use App\Http\Controllers\TransaksiIKSProController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipeIksController;

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
    Route::get('/',[KomponenGroupDetailController::class,'index'])->name('komponengroupdetail.index');
    Route::get('/create',[KomponenGroupDetailController::class,'create'])->name('komponengroupdetail.create');
    Route::post('/store',[KomponenGroupDetailController::class,'store'])->name('komponengroupdetail.store');
    Route::get('/edit/{id}',[KomponenGroupDetailController::class,'edit'])->name('komponengroupdetail.edit');
    Route::post('/{id}/update',[KomponenGroupDetailController::class,'update'])->name('komponengroupdetail.update');
    Route::delete('/{id}',[KomponenGroupDetailController::class,'deleteData'])->name('komponengroupdetail.delete');
    Route::post('/listData',[KomponenGroupDetailController::class,'listData'])->name('komponengroupdetail.listData');
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