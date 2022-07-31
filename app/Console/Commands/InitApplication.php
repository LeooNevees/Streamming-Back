<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para configurar aplicação';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        copy('.env.example', '.env');
        shell_exec('php artisan jwt:secret');
        shell_exec('sail artisan migrate:fresh --seed');
        echo 'Finalizou configuração';
    }
}
