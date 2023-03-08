<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Dołączanie pliku</title>
</head>
<body>
	<h4>Początek strony</h4>
    <?php
        //include, include_once, require, require_once
        include "./scripts/lista.php";
        @include_once "./scripts/lista1.php";

        //require "./scripts/lista.php";
        require_once "./scripts/lista.php";
        @require "./scripts/lista1.php";

    ?>
	<h4>Koniec strony</h4>
</body>
</html>
