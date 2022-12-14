<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\PenjaminController;
use App\Http\Controllers\KomponenGroupsController;
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
    return redirect('/crud');
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

Route::prefix('/komponengroups')->group(function(){
    Route::get('/',[KomponenGroupsController::class,'index'])->name('komponengroups.index');
    Route::get('/create',[KomponenGroupsController::class,'create'])->name('komponengroups.create');
    Route::post('/store',[KomponenGroupsController::class,'store'])->name('komponengroups.store');
    Route::get('/{id}/edit',[KomponenGroupsController::class,'edit'])->name('komponengroups.edit');
    Route::post('/{id}/update',[KomponenGroupsController::class,'update'])->name('komponengroups.update');
    Route::delete('/{id}',[KomponenGroupsController::class,'deleteData'])->name('komponengroups.delete');
    Route::post('/listData',[KomponenGroupsController::class,'listData'])->name('komponengroups.listData');
});
