<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/UserInfo.php';

(new UserInfoModel())->returnResponse();

?>