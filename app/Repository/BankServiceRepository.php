<?php


namespace App\Repository;


use Chumper\Zipper\Zipper;
use DateTime;

class BankServiceRepository implements BankServiceRepositoryInterface
{

    public function getUserTransactionByDate(int $userId, DateTime $date): Zipper
    {
        // TODO: Implement getUserTransactionByDate() method.
    }
}