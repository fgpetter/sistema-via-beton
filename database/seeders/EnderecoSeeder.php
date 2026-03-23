<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnderecoSeeder extends Seeder
{
    public function run(): void
    {
        $sqlFile = base_path('.plans/enderecos.txt');

        if (! file_exists($sqlFile)) {
            $this->command?->warn('Arquivo .plans/enderecos.txt não encontrado. Seeder ignorado.');

            return;
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('enderecos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        DB::unprepared(file_get_contents($sqlFile));

        $count = DB::table('enderecos')->count();
        $this->command?->info("Endereços importados: {$count}");
    }
}
