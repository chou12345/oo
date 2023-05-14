<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/report.php';

    (new Report())->returnResponse();
?>