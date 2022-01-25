<?php
    session_start();
    if (!isset($_SESSION['logged']))
	{
		header('Location: ../login.php');
		exit();
	}
    require_once "./connect.php";
    require_once('../content/admin/Rconconn.php');

    $login = $_SESSION['login'];
    $servername = $_SESSION['servername'];
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
    $host = '';
    $port = 0;
    $password = '';
    use Thedudeguy\Rcon;

    if($_GET['todo'] == "test"){
        $sql = "SELECT * FROM `serversettings` WHERE `servername` = '$servername'";
        $result = $connect->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $host = $row['rconhost'];
                $port = $row['rconport'];
                $password = $row['rconpassword'];
                $c_percent = $row['c_percent'];
            }
        }
        $timeout = 3;
        
        $rcon = new Rcon($host, $port, $password, $timeout);
        
        if ($rcon->connect())
        {
            $rcon->sendCommand("say Witaj! Ta wiadomość pochodzi z panelu konfiguracyjnego RichShop, jeśli ją widzisz to znaczy, że poprawnie ustawiłeś swoje połączenie RCON");
        }
        $_SESSION['rconcmd'] = true;
        header("Location: ../admin.php?data=rcon");
    }else if($_GET['todo'] == "savechanges"){
        $host = $_POST['hostname'];
        $port = $_POST['port'];
        $password = $_POST['password'];

        $sql = "UPDATE `serversettings` SET `rconhost`='$host',`rconport`='$port',`rconpassword`='$password',`c_percent`=$c_percent + 75 WHERE servername = '$servername'";

        if ($connect->query($sql) === TRUE) {
            header("Location: ../admin.php?data=rcon");
        } else {
            echo "<b>BŁĄD SKONAKTUJ SIĘ Z:</b><br /><br />email: <b>kontakt@richweb.com</b><br />";
            echo "<br /><br /> <b>PRZYCZYNA BŁĘDU: </b>" . $sql . "<br>" . $connect->error;
        }
    }


?>