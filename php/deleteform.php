<?php
    session_start();
	if (!isset($_SESSION['logged']))
	{
		header('Location: ../login.php');
		exit();
	}
	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$id = $_POST['id'];
	$type = $_GET['type'];

	$servername = $_SESSION['servername'];

	if($type == "payment"){
		$sql = "UPDATE `userboughts` SET `deleted`=1 WHERE `id` = '$id' AND `servername` = '$servername'";
		$header = "../admin.php?data=payments";
	}
	else if($type == "product"){
		$sql = "DELETE FROM `itemshop` WHERE `id` = '$id'  AND `servername` = '$servername'";
		$header = "../admin.php?data=products";
	}else{
		return header("Location: ../admin.php");
	}

	if ($connect->query($sql) === TRUE) {
        header("Location: $header");
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
		echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>" . $sql . "<br>" . $connect->error;
	}
?>