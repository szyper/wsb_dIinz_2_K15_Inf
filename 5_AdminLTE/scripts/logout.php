<?php
	session_start();
	//echo session_status(); //2
	//echo $_SESSION["logged"]["firstName"];
	unset($_SESSION["logged"]);
	session_destroy();
	//echo session_status(); //1
	//echo $_SESSION["logged"]["firstName"];
	header("location: ../pages/index.php?logout=1");

