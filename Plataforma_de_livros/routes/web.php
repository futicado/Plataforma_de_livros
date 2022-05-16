<?php

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/



Route::get('/', 'Main@login')->name('login');
Route::post('/submissao','Main@submissao')->name('submissao');

Route::get('/dashboard', 'Main@dashboard')->name('dashboard');


Route::get('/cadastrolivro', 'Main@cadastrolivro')->name('cadastrolivro');
Route::get('/cadastrolivrosubmissao', 'Main@cadastrolivrosubmissao')->name('cadastrolivrosubmissao');

