<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Donate.php';
(new Donate())->returnResponse();

?>