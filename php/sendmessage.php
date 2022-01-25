<?php
	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}

    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['message'];

	$sql = "INSERT INTO `contact`(`nickname`,`email`, `content`) VALUES ('$name','$email', '$content')";
	if ($connect->query($sql) === TRUE) {
        header('Location: ../index.html');
	} else {
		header('Location: ../index.html');
	}
?>