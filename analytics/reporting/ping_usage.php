<?php

require_once dirname(__DIR__) . '/_includes/boot.php';

$id = get('id');
$timestamp = now();

$query = db()->prepare('UPDATE usages SET last_activity_at = ? WHERE id = ?');
$query->execute([$timestamp, $id]);
