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

// Api routes
Route::apiResources([
    //business
    'service' => 'ServiceController',
    'section' => 'SectionController',
    'ip' => 'IpController',
    // Management
    'client' => 'ClientController',
]);

// utils
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

// verify email
Auth::routes(['verify' => true]);

// Vue js
Route::get('/{any}', 'SpaController@index')->middleware('auth')->where('any', '.*');
