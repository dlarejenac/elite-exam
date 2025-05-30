<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;

Route::get('/', function () {
    return view('index');
});

Route::get('/php', function () {
    return view('php.index');
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/admin/dashboard/total-albums-sold', [AdminController::class, 'totalAlbumsSold'])->name('dashboard.totalAlbumsSold');
Route::get('/admin/dashboard/combined-sales', [AdminController::class, 'combinedSales'])->name('dashboard.combinedSales');
Route::get('/admin/dashboard/top-artist', [AdminController::class, 'topArtist'])->name('dashboard.topArtist');
Route::get('/admin/dashboard/top-albums-year', [AdminController::class, 'topAlbumsYear'])->name('dashboard.topAlbumsYear');
Route::get('/admin/dashboard/search-albums', [AdminController::class, 'searchAlbumsByArtist'])->name('dashboard.searchAlbumsByArtist');

Route::resource('/artists', ArtistController::class);
Route::resource('/albums', AlbumController::class);

Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');