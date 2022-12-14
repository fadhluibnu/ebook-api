<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HeloController;
use App\Http\Controllers\SiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// contoh satu
Route::get("halo", function () {
    return ["me" => "Ganteng"];
});

// contoh menggunakan controller
// Route::get("halocontroller", [HeloController::class, "index"]);
Route::resource('halocontroller', HeloController::class);
Route::resource("siswa", SiswaController::class);
Route::resource("books", BookController::class);
