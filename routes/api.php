<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
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
Route::resource('halocontroller', HeloController::class);
Route::resource("siswa", SiswaController::class);

// public route

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource("/books", BookController::class)->except("index", "show");
    Route::resource("/authors", AuthorController::class)->except("index", "show");
    Route::post('/logout', [AuthController::class, 'logout']);
});
