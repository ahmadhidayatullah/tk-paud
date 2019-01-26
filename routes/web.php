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

// Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

$all_user = [
    'prefix' => '',
    'middleware' => ['auth'],
];

Route::group($all_user, function () {

    Route::get('logout', function () {
        Auth::logout();
        return redirect('/');
    });
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/create', 'UserController@create')->name('user.create');
        Route::get('/{id}', 'UserController@show')->name('user.show');
        Route::post('/', 'UserController@store')->name('user.create.submit');
        Route::put('/{id}', 'UserController@update_general')->name('user.update.general');
        Route::put('/password/{id}', 'UserController@update_password')->name('user.update.password');
        Route::delete('/{id}', 'UserController@destroy')->name('user.delete');
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', 'RoleController@index')->name('role');
        Route::get('/create', 'RoleController@create')->name('role.create');
        Route::post('/', 'RoleController@store')->name('role.create.submit');
        Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
        Route::put('/{id}', 'RoleController@update')->name('role.update');
        Route::delete('/{id}', 'RoleController@destroy')->name('role.delete');
    });

    Route::group(['prefix' => 'data-guru'], function () {
        Route::get('/', 'DataGuruController@index')->name('data-guru');
        Route::get('/create', 'DataGuruController@create')->name('data-guru.create');
        Route::post('/', 'DataGuruController@store')->name('data-guru.create.submit');
        Route::get('/edit/{id}', 'DataGuruController@edit')->name('data-guru.edit');
        Route::put('/{id}', 'DataGuruController@update')->name('data-guru.update');
        Route::delete('/{id}', 'DataGuruController@destroy')->name('data-guru.delete');
    });

    Route::group(['prefix' => 'data-siswa'], function () {
        Route::get('/', 'DataSiswaController@index')->name('data-siswa');
        Route::get('/create', 'DataSiswaController@create')->name('data-siswa.create');
        Route::get('/{id}', 'DataSiswaController@show')->name('data-siswa.show');
        Route::post('/', 'DataSiswaController@store')->name('data-siswa.create.submit');
        // Route::get('/edit/{id}', 'DataSiswaController@edit')->name('data-siswa.edit');
        // Route::put('/{id}', 'DataSiswaController@update')->name('data-siswa.update');
        Route::delete('/{id}', 'DataSiswaController@destroy')->name('data-siswa.delete');
    });

    Route::group(['prefix' => 'pembayaran'], function () {
        Route::get('/', 'PembayaranController@index')->name('pembayaran');
        Route::post('/', 'PembayaranController@store')->name('pembayaran.submit');
    });

    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', 'LaporanController@index')->name('laporan');
    });

    Route::group(['prefix' => 'kontrol-penitipan'], function () {
        Route::get('/', 'KontrolPenitipanController@index')->name('kontrol-penitipan');
        Route::get('/create', 'KontrolPenitipanController@create')->name('kontrol-penitipan.create');
        Route::post('/', 'KontrolPenitipanController@store')->name('kontrol-penitipan.create.submit');
        // Route::delete('/{id}', 'KontrolPenitipanController@destroy')->name('kontrol-penitipan.delete');
    });

    Route::group(['prefix' => 'log'], function () {
        Route::get('/', 'LogActivityController@index')->name('log');
    });
});
