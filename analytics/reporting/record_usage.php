<?php

require_once dirname(__DIR__) . '/_includes/boot.php';
require_once '_device_id.php';

$secureId = get('secure_id', '');
$id = get_device_id($secureId);

if (!$id) {
    return;
}

$fillable = ['device_id', 'ip_address', 'created_at'];
$columns = implode(',', $fillable);
$values = db_prepare_vars(count($fillable));

$data = [
    'device_id' => $id,
    'ip_address' => $_SERVER['REMOTE_ADDR'],
    'created_at' => now()
];

$query = db()->prepare("INSERT INTO usages ({$columns}) VALUES($values)");
$query->execute(array_values($data));

$launchId = db()->lastInsertId(); 

json_output(['id' => $launchId]);
