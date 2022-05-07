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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $autos = \App\Models\Auto::where('busy_until', '<', now()->toDateTimeString())->get();
        foreach ($autos as $auto) {
            $auto->user_id = null;
            $auto->busy_until = null;
            $auto->save();
        }
        return view('dashboard');
    })->name('dashboard');
});

Route::post('auto/take', [\App\Http\Controllers\AutoController::class, 'take'])->name('auto.take');
