<?php
 use App\User;
use App\Company;
use Illuminate\Http\Request;

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


Route::get('/currentuser', function (Request $request) {
    return $request->user();
})->middleware('auth');

Route::get('/currentcompany', function (Request $request) {
    return Company::find(1);
})->middleware('auth');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('login');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/{any}', 'SpaController@index')->middleware('auth')->where('any', '.*');
