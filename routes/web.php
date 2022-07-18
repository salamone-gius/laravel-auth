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

// definisco dentro un gruppo tutte le rotte che voglio proteggere con l'autenticazione:

// tutte le rotte avranno lo stesso middleware ('auth');
Route::middleware('auth')

    // tutte le rotte avranno lo stesso namespace (i controller saranno dentro la sottocartella 'Admin');
    ->namespace('Admin')

    // i nomi di tutte le rotte inizieranno con 'admin.';
    ->name('admin.')

    // tutte le rotte avranno lo stesso prefisso url '/admin/';
    ->prefix('admin')

    // inserisco tutte le rotte che devono essere protette da autenticazione (backoffice)
    ->group(function () {

        // /home/admin/
        Route::get('/home', 'HomeController@index')->name('home');

    });

