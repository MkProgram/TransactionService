<?php


namespace App\Repository;


use Chumper\Zipper\Zipper;
use DateTime;

interface BankServiceRepositoryInterface
{
    public function getUserTransactionByDate(int $userId, DateTime $date):Zipper;
}