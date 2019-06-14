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
Route::group(['as'=> 'myc::'], function(){
    Route::get('/', 'System\DashboardController@index')->name('dashboard.index');
    Route::resource('contacts', 'System\ContactController');
    Route::resource('messages', 'System\MessageController');

    /* AJAX */
    Route::get('ajax/contact/{id}', 'AjaxController@getInfoContact');

    /* Filter */
    Route::post('messages/filter', 'System\MessageController@getMessagesByContact')->name('messages.filter');
});