<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExitApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para encerrar aplicação';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $retMigrate = shell_exec('./vendor/bin/sail stop');
        echo "\nFinalizou aplicação\n";
    }
}
