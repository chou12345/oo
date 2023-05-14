<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Merchant.php';

(new Merchant())->returnResponse();

?>