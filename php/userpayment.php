<?php
	session_start();

	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$productid = $_POST['id'];
	$servername = "RefCraft.pl";
    $nickname = $_POST['nickname'];
    $item = $_POST['item'];
    $psc = $_POST['pscpin'];
    $value = $_POST['price'];

	$sql = "INSERT INTO userboughts (`servername`,`nick`,`item`,`payment`,`value`,`pin`)
			VALUES ('$servername','$nickname','$item','PSC','$value','$psc')";
	if ($connect->query($sql) === TRUE) {
        $_SESSION['payment'] = true;
        header('Location: ../index.php');
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
		echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>".$connect->error;
	}
?>