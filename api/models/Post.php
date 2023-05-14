<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Donate.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Deposit.php';


class Post extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->method === 'GET') {
            if ($this->requestInfo->path === '/getPost') {
                return $this->getPost(); // 在 generateResponse 路徑條件下建議定義一個方法，讓這裡保持簡潔，除非只寫一行。方法名稱和建議和路徑名稱相同。
            }
        } else if ($this->requestInfo->method === 'POST') {
            $body = json_decode(file_get_contents('php://input'), true);
            if ($this->requestInfo->path === '/addDonate') {
                return $this->addDonate($body);
            }
            if ($this->requestInfo->path === '/addHeart') {
                return $this->addHeart($body);
            }
            if ($this->requestInfo->path === '/deleteHeart') {
                return $this->deleteHeart($body);
            }
            if ($this->requestInfo->path === '/addCollection') {
                return $this->addCollection($body);
            }
            if ($this->requestInfo->path === '/deleteCollection') {
                return $this->deleteCollection($body);
            }
        }
        return $this->pathNotExistsFailInfo;
    }


    function getPost(): array
    {
        $donates = (new Donate())->getDonates();
        $postId = $this->requestInfo->queries['post_id'];

        $res = ['isUnlocked' => $this->checkPostUnlocked($donates)];
        $rs = query(
            "SELECT p.title, p.context, p.price, p.submit_time, gu.nickname, d.dictionary_kind, d.dictionary_name 
            FROM post p
            JOIN general_user gu ON p.general_id = gu.general_id
            JOIN dictionary d ON p.category_id = d.dictionary_id
            WHERE post_id = '$postId';"
        )[0];

        if (!$this->checkPostUnlocked($donates)) {
            $rs['context'] = substr($rs['context'], 0, 30) . '...';
        }
        $rs['price'] = (int) $rs['price'];
        $res['postInfo'] = $rs;
        return $res;
    }

    function addDonate(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $donateAmount = (int) $body['amount'];

        $deposit = new Deposit();

        $userAmount = $deposit->getTotalDeposit()['total_deposit'];
        if ($userAmount < $donateAmount) {
            return getGeneralFailInfo("BALANCE_IS_NOT_ENOUGH", ['balance' => $userAmount]);
        }

        $contract_check = query("SELECT
        article_contract.*,
        article_contract.user_A AS user_A,
        article_contract.user_B AS user_B,
        article_contract.user_C AS user_C,
        article_contract.profit_A AS profit_A,
        article_contract.profit_B AS profit_B,
        article_contract.profit_C AS profit_C
    FROM
        article_contract
    WHERE
        article_contract.post_id = '$postId'")[0];

        $identityId = $this->userInfo->identityId;

        if (sizeof($contract_check) == 0) {
            $userBId = query("SELECT general_id FROM post WHERE post_id = '$postId';")[0]['general_id'];


            query(
                "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
            VALUES ($identityId, $donateAmount, '$postId', NOW(), '$userBId');"
            );
            return getGeneralSuccessInfo(null, ['balance' => $userAmount - $donateAmount]);

        } else {
            $coin_A = $donateAmount * 100 / $contract_check['profit_A'];
            $coin_B = $donateAmount * 100 / $contract_check['profit_B'];
            if ($contract_check['user_C'] != NULL) {
                $coin_C = $donateAmount * 100 / $contract_check['profit_A'];
                query(
                    "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
                VALUES ($identityId, $coin_A, '$postId', NOW(), '{$contract_check['user_A']}');"
                );
                query(
                    "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
                VALUES ($identityId, $coin_B, '$postId', NOW(), '{$contract_check['user_B']}');"
                );
                query(
                    "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
                VALUES ($identityId, $coin_C, '$postId', NOW(), '{$contract_check['user_C']}');"
                );
                query(
                    "INSERT INTO profit_article ( donate_id, user_A, user_B, user_C, coin_A, coin_B, coin_C, profit_time)
                VALUES ($identityId, '{$contract_check['user_A']}', '{$contract_check['user_B']}', '{$contract_check['user_C']}', $coin_A, $coin_B, $coin_C, NOW() );"
                );
            } else {

                query(
                    "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
                VALUES ($identityId, $coin_A, '$postId', NOW(), '{$contract_check['user_A']}');"
                );
                query(
                    "INSERT INTO donate ( donate_user, donate_coin, donate_post, donate_time, user_B )
                VALUES ($identityId, $coin_B, '$postId', NOW(), '{$contract_check['user_B']}');"
                );
                query(
                    "INSERT INTO profit_article ( donate_id, user_A, user_B, user_C, coin_A, coin_B, coin_C, profit_time)
                VALUES ($identityId, '{$contract_check['user_A']}', '{$contract_check['user_B']}', NULL, $coin_A, $coin_B, NULL, NOW() );"
                );
            }
            //還沒改餘額！！
        }

    }
    function addHeart(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "INSERT INTO heart ( send_user, post_id, reply_id, time )
            VALUES ($identityId, '$postId', NULL, NOW() );"
        );
        return getGeneralSuccessInfo();
    }
    function deleteHeart(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "DELETE FROM heart WHERE send_user = '$identityId' AND post_id = '$postId';"
        );
        return getGeneralSuccessInfo();
    }
    function addCollection(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "INSERT INTO collection ( user, post, collection_time )
            VALUES ($identityId, '$postId', NOW() );"
        );
        return getGeneralSuccessInfo();
    }
    function deleteCollection(&$body): array
    {
        if ($this->userInfo->identity !== 'general') {
            return getGeneralFailInfo();
        }
        $postId = $body['post_id'];
        $identityId = $this->userInfo->identityId;
        query(
            "DELETE FROM collection WHERE user = '$identityId' AND post = '$postId';"
        );
        return getGeneralSuccessInfo();
    }


    function checkPostUnlocked($donates = null): bool
    {
        $postId = $this->requestInfo->queries['post_id'];
        $post = query("SELECT price FROM post WHERE post_id = $postId")[0];
        if ($post['price'] === '0' || $this->checkSelfPost()) {
            return true;
        }
        if (!isset($donates)) {
            $donates = (new Donate())->getDonates();
        }
        return sizeof($donates) > 0;
    }
    function checkSelfPost()
    {
        $postId = $this->requestInfo->queries['post_id'];
        $rs = query("SELECT general_id FROM post WHERE post_id = $postId")[0];
        return $rs['general_id'] === $this->userInfo->identityId;
    }
    function checkSelfHeart($heart = null): bool
    {
        $postId = $this->requestInfo->queries['post_id'];
        $identityId = $this->userInfo->identityId;
        $rs = query("SELECT * FROM heart WHERE post_id = '$postId' and send_user = '$identityId'")[0];
        return $rs != null;
    }
    function checkSelfCollection($collection = null): bool
    {
        $postId = $this->requestInfo->queries['post_id'];
        $identityId = $this->userInfo->identityId;
        $rs = query("SELECT * FROM collection WHERE post = '$postId' and user = '$identityId'")[0];
        return $rs != null;
    }
}

?>