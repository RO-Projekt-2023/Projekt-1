<?php
use App\Http\Controllers\ArchiveController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/archive', function () {
    return view('archive');
});

Route::get('/events', function () {
    return view('events');
});

Route::get('/events/get', function () {
    return view('getevent');
});


Route::get('/search', 'ArchiveController@search')->name('search');

