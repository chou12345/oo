<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Transaction.php';

(new Transaction())->returnResponse();
?>