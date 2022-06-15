<?php

use App\Mail\welcomemail;
use Illuminate\Support\Facades\Mail;
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

Route::post('/cadastrolivrosubmissao', 'Main@cadastrolivrosubmissao')->name('cadastrolivrosubmissao');

Route::post('/email', 'Main@email')->name('email');



Route::get('/cadastro','Main@cadastro')->name('cadastro');
Route::post('/verificacadastro','Main@verificacadastro')->name('verificacadastro');


Route::get('/sair','Main@sair')->name('sair');

Route::get('/deletar/{id}','Main@excluir')->name('deletar');

/*Route::get('/email', function(){
    Mail::to('jhonatam.mattoss@gmail.com')->send(new welcomemail());
    return new welcomemail();
});*/
