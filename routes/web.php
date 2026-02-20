<?php

use App\Http\Controllers\RoutingController;
use App\Livewire\Admin\OcorrenciasList;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Livewire\Prestador\MeusAtendimentos;
use Illuminate\Support\Facades\Route;

// Rota do painel (home do sistema autenticado)
Route::redirect('/', '/painel');

Route::group(['prefix' => '/painel', 'middleware' => 'auth'], function () {
    Route::view('/', 'painel.dashboard')->name('painel.dashboard');

    Route::view('/perfil', 'profile.edit')->name('profile.edit');

    Route::group(['prefix' => '/admin'], function () {
        Route::view('/usuarios', 'admin.usuarios')->name('admin.usuarios')->can('admin');
        Route::view('/colaboradores', 'admin.colaboradores')->name('admin.colaboradores')->can('admin');
        Route::get('/ocorrencias', OcorrenciasList::class)->name('admin.ocorrencias')->can('admin');
    });

    Route::group(['prefix' => '/prestador'], function () {
        Route::get('/atendimentos', MeusAtendimentos::class)->name('prestador.atendimentos')->can('prestador');
        Route::get('/atendimentos/{ocorrenciaId}', AtendimentoDetalhe::class)->name('prestador.atendimento')->can('prestador');
    });

});

// Rotas catch-all (devem vir por último para não interceptar rotas do Fortify)
// O Fortify já cria automaticamente as rotas GET/POST para /login, /register, /forgot-password, etc.
Route::group(['prefix' => '/sample-pages'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
