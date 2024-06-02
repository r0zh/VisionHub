<?php

use App\Livewire\Images\GenerateImage;
use App\Livewire\Images\UploadImage;
use Illuminate\Support\Facades\Route;
use App\Livewire\CreatePost;
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

// rerout to the upload page
Route::get('/', function () {
    return redirect('upload');
});

Route::get('posts/create', CreatePost::class)->middleware(['auth', 'verified']);

Route::get('admin/tags', TagAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);
Route::get('admin/users', UserAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);
Route::get('admin/images', ImageAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);
Route::get('admin/loras', LoraAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);
Route::get('admin/checkpoints', CheckpointAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);
Route::get('admin/styles', StyleAdminResource::class)->middleware('checkPermission:admin')->middleware(['auth', 'verified']);

Route::get('create', GenerateImage::class)->middleware(['auth', 'verified'])->name('create');
Route::get('upload', UploadImage::class)->middleware(['auth', 'verified'])->name('upload');

Route::view('gallery', 'gallery')
    ->middleware(['auth'])
    ->name('gallery');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('community', 'community')
    ->middleware(['auth'])
    ->name('community');

Route::get('/private_images/{user}/{file}', [App\Http\Controllers\ImageController::class, 'getImage']);

Route::view('/admin', 'admin')->middleware('checkPermission:admin')->name('admin');

require __DIR__ . '/auth.php';
