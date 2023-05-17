<?php
function sanitizeInput(&$input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlentities($input);
	return $input;
}

//echo $_POST["firstName"]." ==> ".sanitizeInput($_POST["firstName"]).", ilość znaków: ".strlen($_POST["firstName"]);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
//	echo "<pre>";
//		print_r($_POST);
//	echo "</pre>";

	$required_fields =["firstName", "lastName", "email1", "email2", "pass1", "pass2", "birthday", "city_id", "gender"];

//	foreach ($required_fields as $key => $value){
//		echo "$key: $value<br>";
//	}

	session_start();
//	foreach ($_POST as $key => $value){
//		if (empty($value)){
//			$_SESSION["error"] = "Wypełnij wszystkie pola!";
//			echo "<script>history.back();</script>";
//			exit();
//		}
//	}

	$errors = [];

	foreach ($required_fields as $value){
		if (empty($_POST[$value])){
			$errors[] = "Pole <b>$value</b> jest wymagane!";
		}
	}

	if (!empty($errors)){
		$_SESSION["error"] = implode("<br>", $errors);
		echo "<script>history.back();</script>";
		exit();
	}

	//email
	if ($_POST["email1"] != $_POST["email2"])
		$errors[] = "Adresy email są różne!";

	if ($_POST["additional_email1"] != $_POST["additional_email2"]){
		$errors[] = "Adresy dodatkowe email są różne!";
	}else{
		if (empty($_POST["additional_email1"]))
			$_POST["additional_email1"] = NULL;
	}

	//hasło
	if ($_POST["pass1"] != $_POST["pass2"]){
		$errors[] = "Hasła są różne!";
	}else{
		//walidacja hasła
		if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
			$errors[] = "Hasło nie spełnia wymagań!";
		}
	}

	if (!isset($_POST["gender"]))
		$errors[] = "Zaznacz płeć!";

	if (!isset($_POST["terms"]))
		$errors[] = "Zatwierdź regulamin!";

	if (!empty($errors)){
		$_SESSION["error"] = implode("<br>", $errors);
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./connect.php";
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param('s', $_POST["email1"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows != 0){
		$_SESSION["error"] = "Adres $_POST[email1] jest zajęty!";
		echo "<script>history.back();</script>";
		exit();
	}

	foreach ($_POST as $key => $value){
		if (!$_POST["pass1"] && !$_POST["pass2"])
			sanitizeInput($_POST["$key"]);
	}

	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `additional_email`, `city_id`, `firstName`, `lastName`, `birthday`, `gender`, `avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', PASSWORD_ARGON2ID);

	$avatar = ($_POST["gender"] == 'm') ? './jpg/man.png' : './jpg/woman.png';

	$stmt->bind_param('ssissssss', $_POST["email1"], $_POST["additional_email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["birthday"], $_POST["gender"], $avatar, $pass);

	$stmt->execute();

	if ($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie udało się dodać użytkownika!";
	}
}

header("location: ../pages/register.php");