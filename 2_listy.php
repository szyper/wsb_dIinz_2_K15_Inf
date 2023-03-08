<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Listy</title>
</head>
<body>
	<h4>Lista</h4>
	<ul>
		<li>wielkopolska
            <ol>
                <li>Poznań</li>
                <li>Gniezno</li>
                <li>Września</li>
            </ol>
        </li>
		<li>dolnośląskie
          <?php
            $city = "Wrocław";
            echo "<ol>";
                echo "<li>Legnica</li>";
                echo "<li>$city</li>";
            //echo "</ol>";
          ?>
            <li>Bolesławiec</li>
            </ol>
        </li>
		<li>kujawsko-pomorskie</li>
	</ul>
</body>
</html>
