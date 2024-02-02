<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post("login", [\App\Http\Controllers\Api\AuthController::class, "login"])->name("login");
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post("logout", [\App\Http\Controllers\Api\AuthController::class, "logout"])->name("logout");
    Route::apiResource("channel", \App\Http\Controllers\Api\ChannelController::class);
    Route::apiResource("media", \App\Http\Controllers\Api\MediaController::class);
    Route::apiResource("branch", \App\Http\Controllers\Api\BranchController::class);
    Route::apiResource("probability", \App\Http\Controllers\Api\ProbabilityController::class);
    Route::apiResource("source", \App\Http\Controllers\Api\SourceController::class);
    Route::apiResource("type", \App\Http\Controllers\Api\TypeController::class);
    Route::apiResource("status", \App\Http\Controllers\Api\StatusController::class);
    Route::apiResource("lead", \App\Http\Controllers\Api\LeadController::class);
    Route::get('charts/lead', [\App\Http\Controllers\Api\LeadController::class, 'charts'])->name('charts.lead');
});
