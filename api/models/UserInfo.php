<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';

class UserInfoModel extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->path === '/getCurrentUserInfo') {
            return (array) $this->userInfo;
        }
        return $this->pathNotExistsFailInfo;
    }
}

?>