<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Dictionary.php';
(new Dictionary())->returnResponse();

?>