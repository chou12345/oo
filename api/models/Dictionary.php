<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helper.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Base.php';

class Dictionary extends Base
{
    function generateResponse(): array
    {
        if ($this->requestInfo->path === '/getAllArticles') {
            return $this->getAllArticles();
        }
        return $this->pathNotExistsFailInfo;
    }

    function getAllArticles(): array
    {
        return query("SELECT * FROM dictionary WHERE dictionary_kind = '文章'");
    }
}

?>