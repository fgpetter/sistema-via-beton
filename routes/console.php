<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('ocorrencias:importar')
    ->weekdays()
    ->hourly()
    ->timezone('America/Sao_Paulo')
    ->between('07:00', '17:00')
    ->withoutOverlapping();
