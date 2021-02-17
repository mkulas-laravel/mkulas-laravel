<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GetDataGuzzle as data;

class namedays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'name-days:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    /**
     * @var
     */

    protected data $getDataGuzzle;

    /**
     * Create a new command instance.
     * @param data $getDataGuzzle
     */
    public function __construct(data $getDataGuzzle)
    {
        parent::__construct();
        $this->getDataGuzzle = $getDataGuzzle;
    }

    /**
     *
     */
    public function handle()
    {
         $this->getDataGuzzle->insertNamedays();
         $this->info("\n Data update in table -> success.");
    }


}
