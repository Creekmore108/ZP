<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\api\AssetController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\{LoginController,
    LogoutController,
    RegisterController,
    TagController,
    AssetImageController,
    UserController,
    UserReservationController,
    HostReservationController};


Route::get('/tags', TagController::class);

// Assets...
Route::get('/assets', [AssetController::class, 'index']);
Route::get('/assets/{asset}', [AssetController::class, 'show']);
Route::post('/assets', [AssetController::class, 'create'])->middleware(['auth:sanctum', 'verified']);
Route::put('/assets/{asset}', [AssetController::class, 'update'])->middleware(['auth:sanctum', 'verified']);
Route::delete('/assets/{asset}', [AssetController::class, 'delete'])->middleware(['auth:sanctum', 'verified']);

// Asset Photos...
// Route::post('/offices/{office}/images', [OfficeImageController::class, 'store'])->middleware(['auth:sanctum', 'verified']);
// Route::delete('/offices/{office}/images/{image:id}', [OfficeImageController::class, 'delete'])->middleware(['auth:sanctum', 'verified']);

// User Reservations...
// Route::get('/reservations', [UserReservationController::class, 'index'])->middleware(['auth:sanctum', 'verified']);
// Route::post('/reservations', [UserReservationController::class, 'create'])->middleware(['auth:sanctum', 'verified']);
// Route::delete('/reservations/{reservation}', [UserReservationController::class, 'cancel'])->middleware(['auth:sanctum', 'verified']);

// Host Reservations...
// Route::get('/host/reservations', [HostReservationController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
