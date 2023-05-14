<?php

$requestInfo;

function getRequestInfo(): RequestInfo
{
    if (!isset($requestInfo)) {
        session_start();
        $requestInfo = new RequestInfo($_SERVER);
    }
    return $requestInfo;
}

class RequestInfo
{
    public $method;
    public $path;
    public $queries;

    public function __construct($_server)
    {
        $this->method = strtoupper($_server['REQUEST_METHOD']);
        $this->path = $_server['PATH_INFO'];
        $this->queries = $this->getQueryStringObject($_server['REQUEST_URI']);
    }

    private function getQueryStringObject($uri): array
    {
        $obj = [];
        $strs = explode("?", $uri);
        if (!isset($strs[1])) {
            return $obj;
        }
        $qs = explode("&", $strs[1]);
        foreach ($qs as $q) {
            $kv = explode("=", $q);
            $obj[$kv[0]] = $kv[1];
        }
        return $obj;
    }
}
function getGeneralSuccessInfo($msg = null, $extra = null): array
{
    return getGeneralInfo('success', $msg, $extra);
}

function getGeneralFailInfo($msg = null, $extra = null): array
{
    return getGeneralInfo('fail', $msg, $extra);
}

function getGeneralInfo($state, $msg = null, $extra = null)
{
    $response = ['state' => $state];
    if (isset($msg)) {
        $response['message'] = $msg;
    }
    if (isset($extra)) {
        $response['extra'] = $extra;
    }
    return $response;
}
?>