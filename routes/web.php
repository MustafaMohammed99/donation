<?php

use App\Http\Controllers\PaymentsCallbackController;
use App\Http\Controllers\PaymentsController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//require __DIR__ . '/auth.php';
//Route::group([
//    'prefix' => 'admin',
//    'as' => 'admin.'
//], function () {
//    require __DIR__ . '/auth.php';
//});
//
//Route::group([
//    'prefix' => 'association',
//    'as' => 'association.'
//], function () {
//    require __DIR__ . '/auth.php';
//});

require __DIR__ . '/dashboard.php';

Route::get('api/paymentsWithoutAuth/create/{project_id}/{amount}',[PaymentsController::class,'create']);
Route::get('api/payments/callback/success',[PaymentsCallbackController::class,'success'])->name('payments.success');
Route::get('api/payments/callback/cancel',[PaymentsCallbackController::class,'cancel'])->name('payments.cancel');
