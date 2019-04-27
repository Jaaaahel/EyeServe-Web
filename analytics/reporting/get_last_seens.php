<?php

require_once dirname(__DIR__) . '/_includes/boot.php';

$secureId = get('secure_id');

$query = db()->prepare('SELECT * FROM object_history WHERE secure_id = ?');

$query->execute([$secureId]);

header('Content-Type: application/json');

echo json_encode($query->fetchAll(), JSON_PRETTY_PRINT);
