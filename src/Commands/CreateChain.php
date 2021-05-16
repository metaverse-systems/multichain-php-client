<?php

namespace MetaverseSystems\MultiChain\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use ErrorException;

class CreateChain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multichain:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blockchain';

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
        
        Storage::makeDirectory('multichain');
        $command = Storage::path('bin/multichain-util')." -datadir=$mcDir create $name";
        exec($command);

        if(!Storage::exists('multichain/'.$name.'/params.dat'))
        {
            print "Could not create blockchain $name\n";
        }

        $port = 0;

        $chainDir = Storage::path('multichain/'.$name);
        $lines = explode("\n", file_get_contents($chainDir."/params.dat"));
        foreach($lines as $line)
        {
            $value = "";
            $param = explode("=", $line);
            if(trim($param[0]) != "default-rpc-port") continue;

            $value = explode("#", $param[1]);
            $port = intval($value[0]);
        }

        $host = "localhost";
        $user = "";
        $pass = "";
        $lines = explode("\n", file_get_contents($chainDir."/multichain.conf"));
        foreach($lines as $line)
        {   
            $value = "";
            $param = explode("=", $line);
            if($param[0] == "rpcuser") $user = $param[1];
            if($param[0] == "rpcpassword") $pass = $param[1];
        }

        print "Created chain $name on $host:$port\n";
        print "Run 'php artisan multichain:start $name' to start\n";

        DotenvEditor::setKey('MULTICHAIN_RPC_HOST', $host);
        DotenvEditor::setKey('MULTICHAIN_RPC_PORT', $port);
        DotenvEditor::setKey('MULTICHAIN_RPC_USER', $user);
        DotenvEditor::setKey('MULTICHAIN_RPC_PASS', $pass);
        DotenvEditor::save();

        return 0;
    }
}
