<?php


namespace App\Repository;


use Chumper\Zipper\Zipper;
use DateTime;
use Exception;


class BankServiceMockRepository implements BankServiceRepositoryInterface
{

    /**
     * @param int $userId
     * @param DateTime $date
     * @return Zipper
     * @throws Exception
     */
    public function getUserTransactionByDate(int $userId, DateTime $date): Zipper
    {
        $dateString = $date->format('Y-m-d');

        return (new Zipper())->make("storage/app/".$userId . "_$dateString".".zip");
    }
}