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

Route::get('/', [App\Http\Controllers\Frontend\MainController::class, 'index'])->name('home');
Route::get('/map', [App\Http\Controllers\Frontend\MainController::class, 'map'])->name('map');
Route::get('/routes/{id}', [App\Http\Controllers\Frontend\MainController::class, 'route'])->name('routes');
Route::get('/stations/{route_id}/{arr_id}', [App\Http\Controllers\Frontend\MainController::class, 'station'])->name('stations');



//backend routs
Route::get('/backend', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/backend', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::get('/backend/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/backend/main', [App\Http\Controllers\Backend\MainController::class, 'index'])->name('main');
//Route::get('/backend/users', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('users');
//Route::get('/backend/edit-user/{id}', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('/backend/edit-user');
Route::resource('/backend/users', App\Http\Controllers\Backend\UserController::class);
Route::get('/backend/users/editpass/{id}', [App\Http\Controllers\Backend\UserController::class, 'editPass'])->name('editpass');
Route::post('/backend/users/changepass', [App\Http\Controllers\Backend\UserController::class, 'changePass'])->name('changepass');

//Route::delete('/delete.user/{id}', [App\Http\Controllers\Backend\UserController::class, 'delete']);

Route::resource('/backend/stations', App\Http\Controllers\Backend\StationController::class);
Route::get('/backend/stations/addstation/{id}/{step}', [App\Http\Controllers\Backend\StationController::class, 'addStation'])->name('addstation');
Route::resource('/backend/routes', App\Http\Controllers\Backend\RouteController::class);
Route::get('/backend/stations/edit/{id}/{step}', [App\Http\Controllers\Backend\StationController::class, 'edit'])->name('edit');
Route::put('/backend/stations/update/{id}', [App\Http\Controllers\Backend\StationController::class, 'update'])->name('update');

//Social route
Route::resource('/backend/social',\App\Http\Controllers\backend\SocialController::class);
Route::post('social/destroy/{id}',[\App\Http\Controllers\backend\SocialController::class,'destroy']);



//AjaxController
Route::post('/backend/deleterouteimg', [App\Http\Controllers\Backend\AjaxController::class, 'deleteRouteImg'])->name('deleterouteimg');
Route::post('/backend/deletestationimg', [App\Http\Controllers\Backend\AjaxController::class, 'deleteStationImg'])->name('deletestationimg');
Route::post('/backend/deleteimg', [App\Http\Controllers\Backend\AjaxController::class, 'deleteImg'])->name('deleteimg');
Route::post('/backend/getRouteById', [App\Http\Controllers\Backend\AjaxController::class, 'getRouteById'])->name('getRouteById');


