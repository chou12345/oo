<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';

class Merchant extends Base
{

    function generateResponse(): array
    {
        if ($this->requestInfo->path === '/getAllMerchants') {
            return $this->getAllMerchants();
        }
        return $this->pathNotExistsFailInfo;
    }

    function getAllMerchants(): array
    {
        return query("SELECT * FROM merchant");
    }

    function checkMerchantExists($id): bool
    {
        $rs = query("SELECT 1 WHERE exists ( select * FROM merchant WHERE merchant_id = '$id');");
        return sizeof($rs) === 1;
    }
}

?>