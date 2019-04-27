<?php
	require_once dirname(__DIR__) . '/database.php';

	$pdo = Database::connect();
	$query = $pdo->prepare('SELECT * FROM objects');
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $query->execute();

    $objects = $query->fetchAll();
    echo json_encode($objects, JSON_PRETTY_PRINT);
?>