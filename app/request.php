<?php
	require_once dirname(__DIR__) . '/database.php';

	$pdo = Database::connect();

    if(isset($_POST['secureId']) && isset($_POST['Email'])) {
		// Innitialize Variable
	   	$secureId = $_POST['secureId'];
        $Email = $_POST['Email'];

        $sql = $pdo->prepare('INSERT INTO request (secure_id, email) VALUES (:secureId, :Email)');
		$sql->bindParam(':secureId',$secureId);
		$sql->bindParam(':Email', $Email);
		$sql->execute();

  	 }else {
  	 	echo "error";
  	 }
?>