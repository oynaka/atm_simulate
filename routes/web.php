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

Route::match(array('GET', 'POST'), "/", array(
    'uses' => 'BankNoteController@dispense',
    'as' => 'dispense'
));

Route::match(array('GET', 'POST'), "/dispense", array(
    'uses' => 'BankNoteController@dispense',
    'as' => 'dispense'
));

Route::match(array('GET', 'POST'), "/refill", array(
    'uses' => 'BankNoteController@refill',
    'as' => 'refill'
));