<?php

require_once dirname(__DIR__) . '/_includes/boot.php';

$secureId = get('secure_id');
$objectName = get('object_name');

$data = json_input(['secure_id', 'object_name']);

if (!$secureId) {
    $secureId = $data['secure_id'];
}

if (!$objectName) {
    $objectName = $data['object_name'];
}

$query = db()->prepare('SELECT * FROM object_history WHERE secure_id = ? AND object_name = ?');

$query->execute([$secureId, $objectName]);

$timestamp = date('Y-m-d H:i:s');

if ($query->fetch()) {
    $updateQuery = db()->prepare('UPDATE object_history SET last_seen = ? WHERE secure_id = ? AND object_name = ?');

    $updateQuery->execute([$timestamp, $secureId, $objectName]);

    return;
}

$insertQuery = db()->prepare('INSERT INTO object_history (secure_id, object_name, last_seen) VALUES (?, ?, ?)');

$insertQuery->execute([$secureId, $objectName, $timestamp]);
