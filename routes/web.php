<?php

use App\Livewire\Pages\Gallery;
use App\Livewire\Pages\Community;
use App\Livewire\Images\GenerateImage;
use App\Livewire\Images\UploadImage;
use App\Livewire\Moderator\ResolveRequest;
use App\Livewire\Moderator\ResolveRequestResource;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\TagAdminResource;
use App\Livewire\Admin\ImageAdminResource;
use App\Livewire\Admin\UserAdminResource;
use App\Livewire\Admin\LoraAdminResource;
use App\Livewire\Admin\CheckpointAdminResource;
use App\Livewire\Admin\StyleAdminResource;

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
    Route::get('admin/tags', TagAdminResource::class);
    Route::get('admin/users', UserAdminResource::class);
    Route::get('admin/images', ImageAdminResource::class);
    Route::get('admin/loras', LoraAdminResource::class);
    Route::get('admin/checkpoints', CheckpointAdminResource::class);
    Route::get('admin/styles', StyleAdminResource::class);
});

Route::middleware('auth')->middleware('checkPermission:moderator')->group(function () {
    Route::get('resolve', ResolveRequestResource::class)->name('requests');
});

Route::middleware('auth')->group(function () {
    Route::get('create', GenerateImage::class)->middleware(['auth'])->name('create');
    Route::get('upload', UploadImage::class)->middleware(['auth'])->name('upload');
    Route::get('gallery', Gallery::class)->middleware(['auth'])->name('gallery');
    Route::get('community', Community::class)->middleware(['auth'])->name('community');
    Route::view('profile', 'profile')->name('profile');
});

Route::get('/private/images/{user}/{file}', [App\Http\Controllers\ImageController::class, 'getImage']);

require __DIR__ . '/auth.php';