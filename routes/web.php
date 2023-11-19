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
    Route::get('/events/search', 'EventController@search')->name('events.search');
    Route::get('/archive', 'EventController@archive')->name('events.archive');
    Route::get('/events/{event}', 'EventController@show')->name('events.show');



    Route::get('/search', 'ArchiveController@search')->name('search');
});

