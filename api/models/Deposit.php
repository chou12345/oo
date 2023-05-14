<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Transaction.php';

class Deposit extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->method === 'GET') {
            if ($this->requestInfo->path === '/getTotalDeposit') {
                return $this->getTotalDeposit();
            }
        } else if ($this->requestInfo->method === 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            if ($this->requestInfo->path === '/addDepositRecord') {
                return $this->addDepositRecord($body);
            }
        }
        return $this->pathNotExistsFailInfo;
    }


    function getTotalDeposit(): array
    {
        $records = (new Transaction())->getRecords();
        $sum = 0;
        foreach ($records as $record) {
            if ($record['source'] === 'in') {
                $sum += $record['coin'];
            } else {
                $sum -= $record['coin'];
            }
        }
        return ['total_deposit' => $sum];
    }

    function addDepositRecord(&$body): array
    {
        $identityId = $this->userInfo->identityId;
        $bankAccount = $this->userInfo->bankAccount;
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $amount = $body['amount'];
        query("INSERT INTO `deposit` (`deposit_user`, `deposit_coin`, `bank_account`, `deposit_time`) VALUES ($identityId, $amount, '$bankAccount', now());");
        return getGeneralSuccessInfo();
    }
}

?>