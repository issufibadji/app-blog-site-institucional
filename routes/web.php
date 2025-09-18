<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'appName' => config('app.name'),
    ]);
});

Route::get('/teste', function () {
    return Inertia::render('Teste', [
        'mensagem' => 'Inertia está funcionando 🚀'
    ]);
});
require __DIR__ . '/front.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
