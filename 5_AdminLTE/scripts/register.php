<?php
	/*echo "<pre>";
		print_r($_POST);
	echo "</pre>";*/

	session_start();
	foreach ($_POST as $key => $value){
		if (empty($value)){
			$_SESSION["error"] = "Wypełnij wszystkie pola!";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	$error = 0;

	//regulamin
	if (!isset($_POST["terms"])){
		$error = 1;
		$_SESSION["error"] = "Zatwierdź regulamin!";
	}

	//hasło
	if ($_POST["pass1"] != $_POST["pass2"]){
		$error = 1;
		$_SESSION["error"] = "Hasła są różne!";
	}

	//email
	if ($_POST["email1"] != $_POST["email2"]){
		$error = 1;
		$_SESSION["error"] = "Adresy email są różne!";
	}

	//duplakcja adresu email (dokończyć)

	if ($error != 0){
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./connect.php";
	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `birthday`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', PASSWORD_ARGON2ID);

	$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $pass);

	$stmt->execute();

	if ($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie udało się dodać użytkownika!";
	}

	header("location: ../pages/register.php");
