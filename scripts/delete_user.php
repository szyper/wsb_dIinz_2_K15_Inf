<?php
//	echo "delete user";
	require_once  "./connect.php";
	$sql = "DELETE FROM `users` WHERE `users`.`id` = $_GET[deleteUserId]";
	$conn->query($sql);
//	echo $conn->affected_rows;
	$deleteUser = 0;
	if ($conn->affected_rows != 0){
//		echo "Usunięto rekord";
		$deleteUser = $_GET["deleteUserId"];
	}else {
//		echo "Nie usunięto rekordu!";
		$deleteUser = 0;
	}
//	header("location: ../4_db/3_db_table.php?deleteUser=$deleteUser");
	header("location: ../4_db/4_db_table_add.php?deleteUser=$deleteUser");
	?>

<script>
	// history.back();
</script>
