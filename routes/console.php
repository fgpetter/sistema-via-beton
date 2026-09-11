<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('ocorrencias:importar')
    ->weekdays()
    ->hourly()
    ->timezone('America/Sao_Paulo')
    ->between('07:00', '17:00')
    ->withoutOverlapping();

Schedule::command('ocorrencias:importar-imagens')
    ->weekdays()
    ->dailyAt('06:00')
    ->timezone('America/Sao_Paulo')
    ->withoutOverlapping();
