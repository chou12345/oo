<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';

class Donate extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->method === 'GET') {
            if ($this->requestInfo->path === '/getDonates') {
                return $this->getDonates(); // 在 generateResponse 路徑條件下建議定義一個方法，讓這裡保持簡潔，除非只寫一行。方法名稱和建議和路徑名稱相同。
            }
        }
        return $this->pathNotExistsFailInfo;
    }

    function getDonates(): array
    {
        $identity = $this->userInfo->identity;
        $identityId = $this->userInfo->identityId;
        $postId = $this->requestInfo->queries['post_id'];
        // 非一般使用者不可 donate
        if ($identity !== 'general') {
            return [];
        }
        $criterias = [];
        if (isset($identityId)) {
            array_push($criterias, "donate_user = $identityId");
        }
        if (isset($postId)) {
            array_push($criterias, "donate_post = $postId");
        }
        $sql = "SELECT donate_coin, donate_time FROM donate d ";
        if (sizeof($criterias)) {
            $sql .= " WHERE " . implode(' AND ', $criterias);

        }
        return query($sql);
    }

    
}
?>