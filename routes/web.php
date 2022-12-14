<?php

use App\Http\Controllers\CrudController;
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

