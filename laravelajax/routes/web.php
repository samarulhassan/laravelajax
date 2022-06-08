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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/students','StudentController@index')->name('student.index');
Route::post('/add-student','StudentController@addStudent')->name('student.add');
Route::get('/students/{id}','StudentController@getStudentById')->name('student.getbyid');