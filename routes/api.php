<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ImageServeController;
use App\Http\Controllers\Api\ThreeDModelController;
use App\Http\Controllers\Api\ThreeDModelServeController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('models/public', [ThreeDModelController::class, 'index']);
Route::get('model/{id}/thumbnail', [ThreeDModelServeController::class, 'serveThreeDModelThumbnail'])->name('models.thumbnail');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/checkToken', [AuthController::class, 'checkToken']);
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('images/public', [ImageController::class, 'index']);
    Route::get('images/user', [ImageController::class, 'userImages']);
    Route::get('images/all', [ImageController::class, 'allImages'])->middleware(['role:admin']);
    Route::get('images/{id}/get', [ImageServeController::class, 'serveImage'])->name('images.download');
    Route::post('models/upload', [ThreeDModelController::class, 'store']);
    Route::get('models/user/{id}', [ThreeDModelController::class, 'userModels']);
    Route::get('model/{id}/get', [ThreeDModelServeController::class, 'serveThreeDModel'])->name('models.download');
    Route::get('user/{id}/get', [UserController::class, 'user'])->name('user.get');
    Route::get('user/get_id', [UserController::class, 'id'])->name('user.get_id');
});