<?php

namespace MetaverseSystems\MultiChain\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ErrorException;

class StartChain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multichain:start {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start blockchain daemon';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $mcDir = Storage::path('multichain');
        $name = $this->argument('name');
        
        $command = Storage::path('bin/multichaind')." -datadir=$mcDir $name > /dev/null &";
        exec($command);

        return 0;
    }
}
