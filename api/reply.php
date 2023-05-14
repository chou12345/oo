<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Reply.php';

(new Reply())->returnResponse();

?>