<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('dbtecno:about', function (): void {
    $this->info('DBtecno Laravel rewrite hazır.');
})->purpose('DBtecno rewrite durum bilgisini gösterir.');
