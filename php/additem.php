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
	$servername = $_SESSION['servername'];

    $itemtype = $_POST['itemtype'];
    $itemname = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['itemname']);
    $itemprice = $_POST['itemprice'];
    $itemdes = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['itemdes']);
    $itemcmd = $_POST['itemcmd'];
	$date = date("Y-m-d h:i:sa");

	$sql = "INSERT INTO `itemshop`(`servername`,`type`, `title`, `price`, `content`, `cmd`,`date`) VALUES ('$servername','$itemtype', '$itemname', '$itemprice','$itemdes','$itemcmd','$date')";
	if ($connect->query($sql) === TRUE) {
        header('Location: ../admin.php?data=products');
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
		echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>" . $sql . "<br>" . $connect->error;
	}
?>