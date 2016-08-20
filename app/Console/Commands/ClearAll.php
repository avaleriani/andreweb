<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class ClearAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All clear commands in one';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    $this->call('view:clear');
    $this->call('cache:clear');
    $this->call('config:clear');
    $this->call('route:clear');
    $this->call('clear-compiled');
    $this->call('debugbar:clear');
    $this->call('optimize');
    }
}
