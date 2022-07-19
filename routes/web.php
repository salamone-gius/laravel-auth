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

// BACKOFFICE - AREA PUBBLICA (blade) \\

Route::get('/', function () {
    return view('welcome');
});


// BACKOFFICE - AREA PUBBLICA (AREA DI AUTENTICAZIONE: REGISTRAZIONE, LOGIN, RECUPERO PASSWORD) (blade) \\

Auth::routes();


// BACKOFFICE - AREA PRIVATA (CRUD, VISIBILE SOLO ALL'UTENTE REGISTRATO) (blade) \\

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

    // aggiungo la rotta per il PostController. Il metodo resource() nel middleware crea in automatico tutte le rotte del PostController utili per tutte le operazioni di CRUD (index, create, ecc...)
    Route::resource('posts', 'PostController');

    });


// FRONTOFFICE - AREA PUBBLICA (rendering con Vue.js)\\

// sotto tutte le altre rotte, ne definisco una di fallback che reindirizza tutte le rotte che non fanno parte dal backoffice alla pagina Vue.js che gestirà il frontoffice 
Route::get('{any?}', function() {
    return view('guest.home');
})->where('any', '.*');
