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
	$servername = $_SESSION['servername'];
    $nickname = $_POST['nickname'];
    $item = $_POST['item'];
    $psc = $_POST['pscpin'];
    $value = $_POST['price'];

	$sql = "SELECT * FROM itemshop WHERE `servername` = '$servername' AND `id` = '$productid' AND `item` = '$item'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $command = $row['cmd'];
        }
    }

	$sql = "INSERT INTO userboughts (`servername`,`nick`,`item`,`payment`,`command`,`value`,`pin`)
			VALUES ('$servername','$nickname','$item','PSC','$command','$value','$psc')";
	if ($connect->query($sql) === TRUE) {
        $_SESSION['payment'] = true;
        header('Location: /refcraft/index.php');
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
		echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>".$connect->error;
	}
?>