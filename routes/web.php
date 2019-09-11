<?php

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

Route::get('/','WaitlistController@index')->name('waitlist.index');

Route::post('/waitlist', 'WaitlistController@subscribe')->name('waitlist.subscribe');

Route::get('/subscribed', 'WaitlistController@subscribed')->name('waitlist.subscribed');

