<?php


namespace App\Service;


use App\BankUser;
use App\Transaction;
use DateTime;
use Exception;
use Illuminate\Support\Collection;

class TransactionImportService
{

    /**
     * @var BankService
     */
    private $bankService;

    /**
     * TransactionImportService constructor.
     * @param BankService $bankService
     */
    public function __construct(
        BankService $bankService
    )
    {
        $this->bankService = $bankService;
    }


    /**
     * @param DateTime $date
     * @throws Exception
     */
    public function importTransactionsByDate(DateTime $date):void {
        $users = BankUser::all();

        foreach($users as $user) {
            $transactionCollection = $this->bankService->getUserTransactionByDate($user->id, $date);
            $this->saveTransactions($transactionCollection, $user);
        }
    }

    /**
     * @param $user
     * @param DateTime $date
     * @throws Exception
     */
    public function importTransactionsByUserAndDate($user, DateTime $date):void {
        if(is_int($user)) {
            $user = BankUser::find($user);
        }

        $transactionCollection = $this->bankService->getUserTransactionByDate($user->id, $date);
        $this->saveTransactions($transactionCollection, $user);
    }


    /**
     * @param Collection $transactionCollection
     * @param BankUser $user
     */
    private function saveTransactions(Collection $transactionCollection, BankUser $user):void {
        /** @var Transaction $transaction */
        foreach($transactionCollection as $transaction) {
            $this->saveTransaction($user, $transaction);
        }
    }

    /**
     * @param BankUser $user
     * @param Transaction $transaction
     */
    private function saveTransaction(BankUser $user, Transaction $transaction): void
    {
        $user->transactions()->save($transaction);
    }
}