<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProjetoController;
use App\Http\Controllers\ArquivoController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/projetos/busca', function () {
        return Inertia::render('Filtragem');
    })->name('busca');

Route::get('/download/{id}/{slug}',[ArquivoController::class, 'downloadArquivos']);
Route::get('projetos/busca/{slug}',[ProjetoController::class, 'searchBySlug']);
Route::get('/projetos/busca-like/{busca}',[ProjetoController::class,'show']);
Route::get('/projetos/busca-id/{id}',[ProjetoController::class,'showById']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::post('projetos/store', [ProjetoController::class, 'store'])->name('projetos.store');
});
