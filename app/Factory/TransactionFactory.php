<?php


namespace App\Factory;


use App\Transaction;
use DateTime;
use Exception;
use Illuminate\Support\Collection;

class TransactionFactory
{
    /**
     * @param array $transactionData
     * @return Transaction
     * @throws Exception
     */
    public function createFromArray(array $transactionData):Transaction {
        $transactionModel = new Transaction();

        $transactionModel->iban = $transactionData["IBAN"];
        $transactionModel->subject = $transactionData["SUBJECT"];
        $transactionModel->amount = $transactionData["AMOUNT"];
        $transactionModel->date = new DateTime($transactionData["DATE"]);
        return $transactionModel;
    }

    public function createFromArrays(array $transactionCollectionData):Collection {
        return collect($transactionCollectionData)->map(function($transactionData) {
           return $this->createFromArray($transactionData);
        });
    }
}