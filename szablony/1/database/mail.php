<?php
	require_once "connect.php";

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
	$servername = "RichLife.pl";

    $fname = $_POST["name"];
    $email = $_POST["email"];
    $lname = $_POST["subject"];
    $content = $_POST["message"];


	$sql = "INSERT INTO `contact` (`server`,`nickname`, `email`, `title`, `content`) VALUES ('$servername','$fname', '$email', '$lname','$content')";
	if ($connect->query($sql) === TRUE) {
        header('Location: ../index.php');
	} else {
		echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
        echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>" . $sql . "<br>" . $connect->error;
	}
?>
