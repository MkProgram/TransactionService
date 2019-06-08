<?php

namespace Tests\Integration;

use App\Service\BankService;
use App\Transaction;
use DateTime;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class BankServiceTest extends TestCase
{
    /**
     * @var BankService
     */
    private $bankService;

    /**
     * @throws BindingResolutionException
     */
    public function setUp(): void
    {

        parent::setUp();

        $this->bankService = $this->app->make(BankService::class);
    }

    /**
     * @dataProvider GetUserTransactionByDateProvider
     * @param int $userId
     * @param DateTime $date
     * @throws Exception
     */
    public function testGetUserTransactionByDate(int $userId, DateTime $date)
    {
        $transactionCollection = $this->bankService->getUserTransactionByDate($userId, $date);
        foreach($transactionCollection as $transaction) {
            $this->assertInstanceOf(Transaction::class, $transaction);
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function GetUserTransactionByDateProvider() {
        return [
            [1, new DateTime("2019-04-04")]
        ];
    }
}
