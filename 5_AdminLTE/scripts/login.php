<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == 'POST'){
	//print_r($_POST);
	$errors = [];
	foreach ($_POST as $key => $value){
		if(empty($value)){
			$errors[] = "Pole <b>$key</b> musi być wypełnione";
		}
	}
	//print_r($errors);
	//echo $error_message;

	if(!empty($errors)){
		$error_message = implode("<br>", $errors);
		header("Location: ../pages/index.php?error=".urlencode($error_message));
		exit();
	}

	//echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";


	//$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); //  j<b>an@</b>o2.pl  => jban@bo2.pl
	//echo $email;

	//echo htmlentities($_POST["email"]); //j<b>an@</b>o2.pl

	require_once "./connect.php";
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param("s", $_POST["email"]);
	$stmt->execute();
	$result = $stmt->get_result();
	//echo $result->num_rows;

	$error = 0;
	if ($result->num_rows != 0){
		$user = $result->fetch_assoc();
		//print_r($user);
//		echo password_verify($_POST["pass"], $user["password"]);
		if (password_verify($_POST["pass"], $user["password"])){
			$_SESSION["logged"]["firstName"] = $user["firstName"];
			$_SESSION["logged"]["lastName"] = $user["lastName"];
			$_SESSION["logged"]["role_id"] = $user["role_id"];
			$_SESSION["logged"]["session_id"] = session_id();
			//print_r($_SESSION["logged"]);
			header("location: ../pages/logged.php");
			exit();
		}else{
			$error = 1;
		}
	}else{
		$error = 1;
	}

	if ($error != 0){
		$_SESSION["error"] = "Błędny login lub hasło!";
		echo "<script>history.back();</script>";
		exit();
	}

}else{
	header("location: ../pages");
}