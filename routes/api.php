<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AccountController;

Route::post('/conta', [AccountController::class, 'create']);
Route::get('/conta', [AccountController::class, 'fetchOne']);
Route::post('/transacao', [TransactionController::class, 'transact']);
