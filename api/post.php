<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/api/models/Post.php';

(new Post())->returnResponse();

?>