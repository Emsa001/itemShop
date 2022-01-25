<?php

	session_start();
	
	if ((!isset($_POST['login'])) || (!isset($_POST['password'])))
	{
		header('Location: ../login.php');
		exit();
	}

	require_once "./connect.php";

	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		
		$login = $_POST['login'];
		$password = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		$password = htmlentities($password, ENT_QUOTES, "UTF-8");
		if ($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM serversettings WHERE login='%s' AND password='%s'",
		mysqli_real_escape_string($polaczenie,$login),
		mysqli_real_escape_string($polaczenie,$password))))
		{
			$ilu_userow = $rezultat->num_rows;
			if($ilu_userow>0)
			{
				$_SESSION['logged'] = true;
				
				$row = $rezultat->fetch_assoc();
				$_SESSION['id'] = $row['id'];
                $_SESSION['login'] = $row['owner'];
                $_SESSION['servername'] = $row['servername'];
				
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: ../admin.php');
				
			} else {
				
				$_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
				header('Location: ../login.php');
				
			}
			
		}
		
		$polaczenie->close();
	}
	
?>