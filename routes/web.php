<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;

Route::patch('activities/{id}/restore', [ActivityController::class, 'restore'])->name('activities.restore');
Route::resource('activities', ActivityController::class);

Route::get('/', function () {
    return view('welcome');
});