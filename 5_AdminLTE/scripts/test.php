<?php
	$pass = "tajne";
	$hashPass = password_hash($pass, PASSWORD_ARGON2ID);

	echo $hashPass;

	$passUser = "tajne1";
	if (password_verify($passUser, $hashPass)){
		echo "ok";
	}else{
		echo "error";
	}
