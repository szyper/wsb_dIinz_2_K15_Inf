<!doctype html>
<html lang="pl">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="./style/table.css">
	<title>Użytkownicy</title>
</head>
<body>
	<h4>Użytkownicy</h4>
	<?php
		require_once "../scripts/connect.php";
	  $sql = "SELECT * FROM `users` INNER JOIN `cities` ON `users`.`city_id` = `cities`.`id` INNER JOIN `states` ON `cities`.`state_id`=`states`.`id` INNER JOIN `countries` ON `states`.`country_id`=`countries`.`id`;";

    $result = $conn->query($sql);
    echo <<< USERSTABLE
      <table>
        <tr>
          <th>Imię</th>
          <th>Nazwisko</th>
          <th>Data urodzenia</th>
          <th>Miasto</th>
          <th>Województwo</th>
          <th>Państwo</th>
        </tr>
USERSTABLE;

    while($user = $result->fetch_assoc()){
      echo <<< USERSTABLE
        <tr>
          <td>$user[firstName]</td>
          <td>$user[lastName]</td>
          <td>$user[birthday]</td>
          <td>$user[city]</td>
          <td>$user[state]</td>
          <td>$user[country]</td>
        </tr>
USERSTABLE;

    }
    echo "</table>";
	?>
</body>
</html>
