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

class ImportTransactionJob implements ShouldQueue
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
     * @var int
     */
    private $userId;

    /**
     * Create a new job instance.
     *
     * @param DateTime $date
     */
    public function __construct(int $userId, DateTime $date)
    {
        $this->date = $date;
        $this->userId = $userId;
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
        $importService->importTransactionsByUserAndDate($this->userId, $this->date);
    }
}
