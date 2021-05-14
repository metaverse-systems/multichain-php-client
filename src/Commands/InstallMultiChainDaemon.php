<?php

namespace MetaverseSystems\MultiChain\Commands;

use Illuminate\Console\Command;

class InstallMultiChainDaemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multichain:daemon-install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads latest Multichain binaries';

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
        $url = "https://www.multichain.com/download/multichain-2-latest.tar.gz";
        $outputFile = base_path()."/storage/multichain-2-latest.tar.gz";
        file_put_contents($outputFile, file_get_contents($url));
        return 0;
    }
}
