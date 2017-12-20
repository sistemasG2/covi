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

//Pages
Route::get('/', 'pages\PagesController@home');

// Superadmin Routes
Route::get('/superadmin', 'superadmin\SuperAdminController@index');
Route::get('/superadmin/cuentas', 'superadmin\SuperAdminController@accounts');
Route::get('/superadmin/usuarios', 'superadmin\SuperAdminController@users');

//Cuentas
Route::apiResource('/cuentas', 'superadmin\AccountsController');
//Usuarios
Route::apiResource('/usuarios', 'superadmin\UsersController');


// Route::get('/superadmin/cuentas', 'superadmin\SuperAdminController@accounts');
// Route::get('/superadmin/dashboard', 'superadmin\SuperAdminController@index');
// Route::get('/superadmin/perfil', 'superadmin\SuperAdminController@profile');
// Route::get('/superadmin/reportes', 'superadmin\SuperAdminController@reports');
// Route::get('/superadmin/soporte', 'superadmin\SuperAdminController@support');
// Route::get('/superadmin/usuarios', 'superadmin\SuperAdminController@users');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
