<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group that
| contains the "web" middleware group.
|
*/

// Redirect root to login
Route::redirect('/', '/login');

// Authentication routes
require __DIR__ . '/auth.php';

// Admin routes
Route::prefix('admin')
    ->name('admin.')
    ->namespace('Admin')
    ->group(function () {

        // Guest admin login routes
        Route::namespace('Auth')
            ->middleware(['guest:admin', 'xss'])
            ->group(function () {
                Route::get('login', 'AuthenticatedSessionController@create')->name('login');
                Route::post('login', 'AuthenticatedSessionController@store')->name('adminlogin');
            });

        // Authenticated admin routes
        Route::middleware(['admin', 'xss'])->group(function () {
            Route::view('error/419', 'errors.419');

            // Team routes
            Route::prefix('teams')->name('teams.')->group(function () {
                Route::get('/', 'TeamsController@index')->name('index');
                Route::get('details', 'TeamsController@show')->name('details');
                Route::get('edit', 'TeamsController@edit')->name('edit');
                Route::post('update', 'TeamsController@update')->name('update');
                Route::post('add', 'TeamsController@create')->name('add');
                Route::post('store', 'TeamsController@store')->name('store');
                Route::post('delete', 'TeamsController@destroy')->name('destroy');
                Route::post('removeMember', 'TeamsController@removeMember')->name('removeMember');
            });
        });

        // Admin logout
        Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
    });
