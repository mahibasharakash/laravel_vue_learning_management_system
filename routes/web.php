<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;

Route::get('/admin/auth/{any}', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin.auth.any');
Route::get('/admin/auth', function () { return redirect()->route('lvs.admin.auth.any', 'login'); } );
Route::get('/admin/{any}', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin.any');
Route::get('/admin', [AppController::class, 'admin'])->where('any', '.*')->name('lvs.admin');

Route::get('auth/{any}', [AppController::class, 'index'])->where('any', '.*')->name('lvs.index.auth.any');
Route::get('auth', function () { return redirect()->route('lvs.index.auth.any', 'login'); } );
Route::get('{any}', [AppController::class, 'index'])->where('any', '.*')->name('lvs.index.any');
Route::get('', [AppController::class, 'index'])->where('any', '.*')->name('lvs.index');
