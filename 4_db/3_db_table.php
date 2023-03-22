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
	  $sql = "select `users`.`id`, `users`.`firstName`, `users`.`lastName`, `users`.`birthday`, `cities`.`city`, `states`.`state`, `countries`.`country` FROM `users` INNER JOIN `cities` ON `users`.`city_id` = `cities`.`id` INNER JOIN `states` ON `cities`.`state_id`=`states`.`id` INNER JOIN `countries` ON `states`.`country_id`=`countries`.`id`;";

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

    if ($result->num_rows > 0){
	    while($user = $result->fetch_assoc()){
		    echo <<< USERSTABLE
        <tr>
          <td>$user[firstName]</td>
          <td>$user[lastName]</td>
          <td>$user[birthday]</td>
          <td>$user[city]</td>
          <td>$user[state]</td>
          <td>$user[country]</td>
          <td><a href="../scripts/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
        </tr>
USERSTABLE;
	    }
    }else{
	    echo <<< USERSTABLE
        <tr>
          <td colspan="6">Brak rekordów do wyświetlenia</td>
        </tr>
USERSTABLE;
    }

    echo "</table>";
    if (isset($_GET["deleteUser"])){
	    if ($_GET["deleteUser"] != 0){
		    echo "<hr>Usunięto użytkownika o id = $_GET[deleteUser]";
	    }else{
		    echo "<hr>Nie usunięto użytkownika";
	    }
    }

	?>
</body>
</html>
