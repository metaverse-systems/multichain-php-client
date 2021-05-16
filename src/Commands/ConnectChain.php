<?php

namespace MetaverseSystems\MultiChain\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use ErrorException;

class ConnectChain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multichain:connect {chain : name@host:port }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to an existing blockchain';

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
        $chain = $this->argument('chain');
        
        $command = Storage::path('bin/multichaind')." -datadir=$mcDir $chain -daemon > /dev/null &";
        exec($command);

        return 0;
    }
}
