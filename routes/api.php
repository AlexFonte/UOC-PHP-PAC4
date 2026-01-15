<?php

use App\Http\Controllers\Api\ApiMuseumController;
use Illuminate\Support\Facades\Route;

Route::get('/museums/{page}', [ApiMuseumController::class, 'museums'])
    ->whereNumber('page');

Route::get('/museum/{id}', [ApiMuseumController::class, 'museum'])
    ->whereNumber('id');

Route::get('/topic/{id}/{page}', [ApiMuseumController::class, 'topic'])
    ->whereNumber('id')
    ->whereNumber('page');
