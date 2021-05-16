<?php

namespace MetaverseSystems\MultiChain\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use splitbrain\PHPArchive\Tar;

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
        $mcFilename = "multichain-2-latest.tar.gz";
        $url = "https://www.multichain.com/download/".$mcFilename;
        $outputFile = Storage::path(".")."/".$mcFilename;
        file_put_contents($outputFile, file_get_contents($url));

        $tar = new Tar();
        $tar->open($outputFile);
        
        $dirname = "";
        $files = array();
        $toc = $tar->contents();
        foreach($toc as $entry)
        {
            if($entry->getIsdir()) $dirname = $entry->getPath();
            else array_push($files, $entry->getPath());
        }
        $tar->close();

        $tar->open($outputFile);
        $tar->extract(Storage::path("."));
        $tar->close();

        foreach($files as $inFile)
        {
            $outFile = str_replace($dirname, "bin", $inFile);
            Storage::move($inFile, $outFile);
        }

        Storage::deleteDirectory($dirname);
        Storage::delete($mcFilename);
        Storage::makeDirectory("multichain");
        return 0;
    }
}
