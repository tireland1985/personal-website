<?php
    require_once 'secrets.php';
	$pdo = new PDO('mysql:dbname=' . $DB_NAME . ';host=' . $DB_HOST, $DB_USER, $DB_PASSWORD,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);