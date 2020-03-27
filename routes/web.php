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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });
    Route::prefix('roleRegister')->group(function () {
        Route::get('', 'Admin\DashboardController@registered');
        Route::post('/addUser', 'Admin\DashboardController@registerAddUser');
        Route::get('/{id}/edit', 'Admin\DashboardController@registerEdit');
        Route::post('/{id}/update', 'Admin\DashboardController@registerUpdate');
        Route::post('/{id}/delete', 'Admin\DashboardController@registerDelete');
    });
    Route::get('/abouts','Admin\AboutController@index');
    Route::post('/save-aboutus','Admin\AboutController@store');
    Route::get('/about-us/{id}','Admin\AboutController@edit');
    Route::post('/aboutus-update/{id}','Admin\AboutController@update');
    Route::post('/about-us-delete/{id}','Admin\AboutController@delete');
});



// Route::post('/addUser', 'Admin\DashboardController@addUser');
// Route::post('/editUser', 'Admin\DashboardController@editUser');
// Route::post('/deleteUser', 'Admin\DashboardController@deleteUser');