<?php
 use App\User;

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
    dump("hello world");
    return view('welcome');
})->middleware('verified');

Route::get('/about', function () {
    $users = User::all();
    dump($users->toArray());
    return view('welcome');
})->middleware('verified');

Route::post('/contact', function () {
    dump(request()->all());
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
