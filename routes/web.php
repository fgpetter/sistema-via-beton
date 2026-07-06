<?php

use App\Http\Controllers\Admin\DownloadRatPdfController;
use App\Http\Controllers\Admin\DownloadRelatorioAtendimentoPdfController;
use App\Http\Controllers\RoutingController;
use App\Http\Middleware\RedirectPrestadorDashboard;
use App\Livewire\Admin\OcorrenciasList;
use App\Livewire\Admin\PreventivasList;
use App\Livewire\Prestador\AtendimentoDetalhe;
use App\Livewire\Prestador\MeusAtendimentos;
use Illuminate\Support\Facades\Route;

// Rota do painel (home do sistema autenticado)
Route::redirect('/', '/painel');

Route::group(['prefix' => '/painel', 'middleware' => 'auth'], function () {
    Route::view('/', 'painel.dashboard')->name('painel.dashboard')->middleware(RedirectPrestadorDashboard::class);

    Route::view('/perfil', 'profile.edit')->name('profile.edit');

    Route::group(['prefix' => '/admin'], function () {
        Route::view('/usuarios', 'admin.usuarios')->name('admin.usuarios')->can('admin');
        Route::view('/colaboradores', 'admin.colaboradores')->name('admin.colaboradores')->can('admin');
        Route::get('/ocorrencias', OcorrenciasList::class)->name('admin.ocorrencias')->can('admin');
        Route::get('/ocorrencias/{ocorrencia}/rat-pdf', DownloadRatPdfController::class)->name('admin.ocorrencias.rat-pdf')->can('admin');
        Route::get('/ocorrencias/{ocorrencia}/relatorio-atendimento-pdf', DownloadRelatorioAtendimentoPdfController::class)->name('admin.ocorrencias.relatorio-atendimento-pdf')->can('admin');
        Route::get('/preventivas', PreventivasList::class)->name('admin.preventivas')->can('admin');
        Route::get('/preventivas/{preventiva}/vistoria-pdf', App\Http\Controllers\Admin\DownloadVistoriaPdfController::class)->name('admin.preventivas.vistoria-pdf')->can('admin');
        Route::get('/preventivas/{preventiva}/relatorio-executivo-pdf', App\Http\Controllers\Admin\DownloadRelatorioExecutivoPdfController::class)->name('admin.preventivas.relatorio-executivo-pdf')->can('admin');
        Route::get('/preventivas/{preventiva}/relatorio-medicao-pdf', App\Http\Controllers\Admin\DownloadRelatorioMedicaoPdfController::class)->name('admin.preventivas.relatorio-medicao-pdf')->can('admin');
        Route::view('/enderecos', 'admin.enderecos')->name('admin.enderecos')->can('admin');
        Route::view('/configuracoes-sistema', 'admin.configuracoes-sistema')->name('admin.configuracoes-sistema')->can('admin');
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
