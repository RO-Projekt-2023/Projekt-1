<?php
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/archive', function () {
    return view('archive');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/events', 'EventController@index')->name('events.index');
    Route::post('/events/{event}/apply', 'EventController@apply')->name('events.apply');

    Route::get('/search', 'ArchiveController@search')->name('search');
});

