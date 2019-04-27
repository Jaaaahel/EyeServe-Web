<?php

date_default_timezone_set('Asia/Manila');

include 'database.php';
include 'helpers.php';

session_start();

$_db = new Database();

function db()
{
    global $_db;
    
    return $_db->getPdo();
}
