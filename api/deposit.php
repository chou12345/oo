<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Deposit.php';
(new Deposit())->returnResponse();

?>