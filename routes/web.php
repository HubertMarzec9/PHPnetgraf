<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');

Route::view('/get', 'get');
Route::view('/post', 'post');
Route::view('/put', 'put');
Route::view('/delete', 'delete');
Route::view('/error', 'error')->name('error');

////

Route::POST('findById', [PetController::class, 'findById'])->name('findById');;
Route::GET('findById', [PetController::class, 'findById'])->name('findById');;
Route::POST('findByStatus', [PetController::class, 'findByStatus'])->name('findByStatus');

Route::POST('delete', [PetController::class, 'destroy'])->name('delete');

Route::POST('update', [PetController::class, 'update'])->name('update');
Route::POST('add', [PetController::class, 'add'])->name('add');
Route::POST('updatePetById', [PetController::class, 'updatePetById'])->name('updatePetById');
