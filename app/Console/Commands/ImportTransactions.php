<?php

namespace App\Console\Commands;

use App\Jobs\DailyTransactionImportJob;
use DateTime;
use Exception;
use Illuminate\Console\Command;

class ImportTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:import:queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the transaction data from a specific user.';

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
     * @throws Exception
     */
    public function handle()
    {
        DailyTransactionImportJob::dispatch(new DateTime("2019-04-04"));
    }
}
