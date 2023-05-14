<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Deposit.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Merchant.php';

class Transaction extends Base
{

    function generateResponse(): array
    {
        if ($this->requestInfo->method === 'GET') {
            if ($this->requestInfo->path === '/getRecords') {
                return $this->getRecords();
            }
        } else if ($this->requestInfo->method === 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            if ($this->requestInfo->path === '/addConsumption') {
                return $this->addConsumption($body);
            }
        }
        return $this->pathNotExistsFailInfo;
    }


    /*
    一般 : 儲值 消費 斗內
    管理 : 自己一筆
    商家 : 提領 入賬
    */
    function getRecords(): array
    {
        $identityId = $this->userInfo->identityId;
        if ($this->userInfo->identity === 'manager') {
            return query("SELECT balance AS 'coin', 'in' AS 'source', '初始金額' AS 'detail' FROM manager where manager_id = '$identityId'");
        } else if ($this->userInfo->identity === 'merchant') {
            return query(
                "SELECT * FROM (
                SELECT consumption_coin AS 'coin', consumption_time AS 'time', 'in' AS 'source', gu.name as 'detail'
                FROM consumption c JOIN general_user gu
                ON c.consumption_user = gu.account_id
                WHERE consumption_merchant = '$identityId'
                UNION
                SELECT withdraw_coin, withdraw_time, 'out' AS 'source', '提款' AS 'detail'
                FROM withdraw
                WHERE withdraw_user = '$identityId'
            ) AS u ORDER BY time DESC"
            );
        } else if ($this->userInfo->identity === 'general') {
            return query(
                "SELECT * FROM (
                SELECT consumption_coin AS 'coin', consumption_time AS 'time', 'out' AS 'source', m.name as 'detail'
                FROM consumption c JOIN merchant m
                ON c.consumption_merchant = m.merchant_id
                WHERE consumption_user = '$identityId'
                UNION
                SELECT deposit_coin, deposit_time, 'in' AS 'source', '儲值' AS 'detail'
                FROM deposit
                WHERE deposit_user = '$identityId'
                UNION
                SELECT donate_coin, donate_time,
                case when donate_user = '$identityId' then 'out' else 'in' end AS 'source',
                case when donate_user = '$identityId' then concat('打賞文章 : ', p.title) else concat('收到打賞 : ', gu.name) end  AS 'detail'
                FROM donate d
                JOIN post p ON d.donate_post = p.post_id
                JOIN general_user gu on gu.general_id = d.donate_user
                WHERE donate_user = '$identityId' OR user_B = '$identityId'
            ) AS u ORDER BY time DESC;
            "
            );
        }
        return getGeneralFailInfo();
    }

    /**
     * 增加一筆消費紀錄
     */
    function addConsumption(&$body)
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo('NOT_CORRECT_IDENTITY');
        }
        $identityId = $this->userInfo->identityId;
        $uniformNumber = $body['uniformNumber'];
        $consumptionAmount = (int) $body['amount'];
        $deposit = new Deposit();

        $userAmount = $deposit->getTotalDeposit()['total_deposit'];
        if ($consumptionAmount > $userAmount) {
            return getGeneralFailInfo("BALANCE_IS_NOT_ENOUGH", ['balance' => $userAmount]);
        }
        $merchant = new Merchant();
        if (!$merchant->checkMerchantExists($uniformNumber)) {
            return getGeneralFailInfo("MERCHANT_NOT_EXISTS");
        }
        query(
            "INSERT INTO consumption (consumption_user, consumption_coin, consumption_merchant, consumption_time)
            VALUES ('$identityId', $consumptionAmount, '$uniformNumber', NOW());
        ");
        return getGeneralSuccessInfo(null, ['balance' => $userAmount - $consumptionAmount]);
    }
}

?>