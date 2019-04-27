<?php

require_once dirname(__DIR__) . '/_includes/boot.php';

$fillable = [
    'secure_id',
    'device_name',
    'api_level',
    'model',
    'manufacturer',
    'brand',
    'carrier_name',
    'imei',
    'screen_width',
    'screen_height'
];

$columns = implode(',', $fillable);
$values = db_prepare_vars(count($fillable));
$data = json_input($fillable);

$query = db()->prepare("INSERT INTO devices ({$columns}) VALUES($values)");
$query->execute(array_values($data));
