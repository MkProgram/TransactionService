<?php

namespace App\Http\Controllers;

use App\BankUser;
use App\Http\Controllers\Exception\InvalidUserException;
use App\Jobs\ImportTransactionJob;
use App\Service\TransactionImportService;
use DateTime;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * @var TransactionImportService
     */
    private $transactionImportService;

    public function __construct(TransactionImportService $transactionImportService)
    {
        $this->transactionImportService = $transactionImportService;
    }


    /**
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function importTransactions(Request $request) {
        $userId = $request->get("userId");
        $date = new DateTime($request->get("date"));

        $this->getUserOrFail($userId);

        ImportTransactionJob::dispatch($userId, $date);
        return [
            "success"=> true
        ];
    }

    /**
     * @param int $userId
     * @return BankUser
     * @throws InvalidUserException
     */
    private function getUserOrFail(int $userId)
    {
        $user = BankUser::find($userId);
        if(!empty($user)) {
            return $user;
        }
        throw new InvalidUserException("User ID is not valid. Given $userId");
    }
}
