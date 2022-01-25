<?php
	session_start();

	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
    $servername = $_SESSION['servername'];
	$p_method = $_POST['p_method'];
    $p_checked = $_POST['p_change'];

    $sql = "UPDATE `serversettings` SET `$p_method` = $p_checked WHERE `servername` = '$servername'";
	if ($connect->query($sql) === TRUE) {
        header("Location: ../admin.php?data=paysettings");
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
		echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>" . $sql . "<br>" . $connect->error;
        header("Location: ../admin.php?data=paysettings");
	}
?>