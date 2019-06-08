<?php

namespace App\Jobs;

use App\Service\TransactionImportService;
use DateTime;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DailyTransactionImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var TransactionImportService
     */
    private $importService;

    /**
     * @var DateTime
     */
    private $date;

    /**
     * Create a new job instance.
     *
     * @param DateTime $date
     */
    public function __construct(DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * Execute the job.
     *
     * @param TransactionImportService $importService
     * @return void
     * @throws Exception
     */
    public function handle(TransactionImportService $importService)
    {
        $importService->importTransactionsByDate($this->date);
    }
}
