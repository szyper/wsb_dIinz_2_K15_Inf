<?php
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

	echo "email: ".$_POST["email"].", hasło: ".$_POST["pass"]."<br>";


	//$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL); //  j<b>an@</b>o2.pl  => jban@bo2.pl
	//echo $email;

	echo htmlentities($_POST["email"]); //j<b>an@</b>o2.pl

}else{
	header("location: ../pages");
}