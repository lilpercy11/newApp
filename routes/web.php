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



Route::get('/', 'App\Http\Controllers\ModuleController@list');

Route::get('/Login', function () {
    return view('Login');
});

//Route::get('/Register', function () {
//    return view('Register');
//});
Route::get('/Register', 'App\Http\Controllers\ModuleController@create')->name('Register');;
Route::get('/ViewProfile', 'App\Http\Controllers\ModuleController@ViewProfile')->name('ViewProfile');;
Route::post('/Register', 'App\Http\Controllers\ModuleController@storeNewUser');
Route::post('/Login', 'App\Http\Controllers\ModuleController@login' )->name('Login');;

//Route::get('/List', 'App\Http\Controllers\ModuleController@list');
Route::get('/Filter/{filterBy}', 'App\Http\Controllers\ModuleController@filterEvents');

Route::POST('/Search', 'App\Http\Controllers\ModuleController@searchEvents')->name('Search');

Route::get('/EditEvent/{EventID}', 'App\Http\Controllers\ModuleController@EditEventGet')->name('EditEventGet');
Route::get('/DeleteEvent/{EventID}', 'App\Http\Controllers\ModuleController@deleteEvent');
Route::get('/DeleteImage/{EventID}/{Image}', 'App\Http\Controllers\ModuleController@deleteImageFromEvent')->name('deleteImageFromEvent');

Route::post('/EditEvent/{EventID}', 'App\Http\Controllers\ModuleController@EditEventPost');

Route::get('/CreateEvent',function () {
    return view('/CreateEvent');
})->name('CreateEvent');;
Route::post('/CreateEvent', 'App\Http\Controllers\ModuleController@createEvent' );
Route::get('/Event/{EventID}', 'App\Http\Controllers\ModuleController@eventPage')->name('eventPage');
Route::get('/Interest/{EventID}', 'App\Http\Controllers\ModuleController@interest');

Route::get('/logout', 'App\Http\Controllers\ModuleController@logout')->name('logout');;
