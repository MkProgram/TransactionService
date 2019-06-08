<?php


namespace App\Service;


use App\Csv\Converter\CsvConverter;
use App\Factory\TransactionFactory;
use App\Repository\BankServiceRepositoryInterface;
use Chumper\Zipper\Zipper;
use DateTime;
use Exception;
use Illuminate\Support\Collection;

class BankService
{
    /**
     * @var BankServiceRepositoryInterface
     */
    private $bankServiceRepository;

    /**
     * @var Zipper
     */
    private $zipper;
    /**
     * @var TransactionFactory
     */
    private $transactionFactory;
    /**
     * @var CsvConverter
     */
    private $csvConverter;

    public function __construct(
        BankServiceRepositoryInterface $bankServiceRepository,
        Zipper $zipper,
        CsvConverter $csvConverter,
        TransactionFactory $transactionFactory
    )
    {
        $this->bankServiceRepository = $bankServiceRepository;
        $this->zipper = $zipper;
        $this->transactionFactory = $transactionFactory;
        $this->csvConverter = $csvConverter;
    }

    /**
     * @param int $userId
     * @param DateTime $date
     * @return Collection
     * @throws Exception
     */
    public function getUserTransactionByDate(int $userId, DateTime $date):Collection {
        $transactionZip = $this->bankServiceRepository->getUserTransactionByDate($userId, $date);
        $dateString = $date->format('Y-m-d');
        $transactionCsv = $transactionZip->getFileContent($userId."_$dateString".".csv");

        $transactionArray = $this->csvConverter->fromStringToArray($transactionCsv);

        return $this->transactionFactory->createFromArrays($transactionArray);
    }



}