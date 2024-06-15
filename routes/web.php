<?php

use App\Livewire\Moderator\ResolveRequest;
use App\Livewire\Pages\Admin\CheckpointResource;
use App\Livewire\Pages\Admin\ImageResource;
use App\Livewire\Pages\Admin\LoraResource;
use App\Livewire\Pages\Admin\TagResource;
use App\Livewire\Pages\Admin\UserResource;
use App\Livewire\Pages\Community;
use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\GenerateImage;
use App\Livewire\Pages\Moderator\ResolveRequestResource;
use App\Livewire\Pages\UploadImage;
use App\Livewire\Pages\UserImages;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect()->away('index.html');
})->name('landing');
// rerout to the upload page



Route::middleware('auth')->middleware('checkPermission:admin')->group(function () {
    Route::get('admin/tags', TagResource::class);
    Route::get('admin/users', UserResource::class);
    Route::get('admin/images', ImageResource::class);
    Route::get('admin/loras', LoraResource::class);
    Route::get('admin/checkpoints', CheckpointResource::class);
});

Route::middleware('auth')->middleware('checkPermission:moderator')->group(function () {
    Route::get('resolve', ResolveRequestResource::class)->name('requests');
});

Route::middleware('auth')->group(function () {
    Route::get('create', GenerateImage::class)->middleware(['auth'])->name('create');
    Route::get('upload', UploadImage::class)->middleware(['auth'])->name('upload');
    Route::get('gallery', Gallery::class)->middleware(['auth'])->name('gallery');
    Route::get('community', Community::class)->middleware(['auth'])->name('community');
    Route::get('user/{user_id}', UserImages::class)->middleware(['auth'])->name('user');
    Route::view('profile', 'profile')->name('profile');
});

Route::get('/private/images/{user}/{file}', [App\Http\Controllers\ImageController::class, 'getImage']);

require __DIR__ . '/auth.php';