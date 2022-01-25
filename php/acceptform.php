<?php
    session_start();
	if (!isset($_SESSION['logged']))
	{
		header('Location: ../login.php');
		exit();
	}
	require_once "connect.php";
	require_once('../content/admin/Rconconn.php');
	$servername = $_SESSION['servername'];

	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	use Thedudeguy\Rcon;

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
    $id = $_POST['id'];
	$sql = "SELECT * FROM `userboughts` WHERE `deleted` = 'false' AND `id` = '$id'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nickname = $row['username'];
			$item = $row['item'];
			$sql2 = "UPDATE `userboughts` SET `accepted`= true WHERE id = '$id'";
			if ($connect->query($sql2) === TRUE) {
				$sql3 = "SELECT * FROM `serversettings` WHERE `servername` = '$servername'";
				$result3 = $connect->query($sql3);
				if ($result3->num_rows > 0) {
					while($row3 = $result3->fetch_assoc()) {
						$host = $row3['rconhost'];
						$port = $row3['rconport'];
						$password = $row3['rconpassword'];
					}
				}
				$rconcmd = explode(";", $row4['command']);

				$timeout = 3;
				
				$rcon = new Rcon($host, $port, $password, $timeout);

				if ($rcon->connect())
				{
					for($i = 0; $i < count($rconcmd); $i++){
						$rcon->sendCommand("list");
						$x = $rcon->getResponse();

						if (preg_match("/\b$nickname\b/", $x)) {
							echo "<br />jest taki gracz";
							$rcon->sendCommand(str_replace("{player}", "$nickname", "$rconcmd[$i]"));
							$_SESSION['paymentaccepted'] = true;
						}else{
							$sql = "UPDATE `userboughts` SET `accepted`= false WHERE id = '$id'";
							$connect->query($sql);
							echo "<br />Nie ma takiego gracza";
							$_SESSION['paymentaccepted'] = false;
							$_SESSION['nosuchplayer'] = true;
						}
						
					}
				}
				header("Location: ../admin.php?data=payments");
			}
		}
	}
?>