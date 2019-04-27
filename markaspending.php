<?php

require 'database.php';

$pdo = Database::connect();
$id = $_GET['id'];

$query = $pdo->prepare('UPDATE request SET status = "Pending" WHERE id = ?');

$query->execute([$id]);

header('Location: /messages.php');
