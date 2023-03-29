<?php
	session_start();
	// print_r($_POST);
	foreach ($_POST as $key => $value){
		// echo "$key: $value<br>";
		if (empty($value)){
			// echo "$key<br>";
			$_SESSION["error"] = "Wypełnij wszystkie pola w formularzu!";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	require_once "./connect.php";
	$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `birthday`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[birthday]');";
	$conn->query($sql);

	// echo $conn->affected_rows;
	if ($conn->affected_rows == 1){
		// echo "Prawidłowo dodano rekord";
		$_SESSION["error"] = "Prawidłowo dodano rekord";
	}else{
		// echo "Nie dodano rekordu!";
		$_SESSION["error"] = "Nie dodano rekordu!";
	}

	header("location: ../4_db/4_db_table_add.php");








