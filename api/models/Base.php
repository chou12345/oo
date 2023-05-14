<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/api.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/userinfo.php';

abstract class Base
{
    public $requestInfo;
    public $userInfo;
    public $pathNotExistsFailInfo;

    function __construct()
    {
        $this->requestInfo = getRequestInfo();
        $this->userInfo = getUserInfo();
        $this->pathNotExistsFailInfo = getGeneralFailInfo('the path does not exist.');
    }

    abstract public function generateResponse(): array;
    public function returnResponse()
    {
        $response = $this->generateResponse();
        $json = json_encode($response);
        echo $json;
    }
}

?>