<?php
    session_start();
    if (!isset($_SESSION['logged']))
    {
        header('Location: ./login.php');
        exit();
    }
    error_reporting(0);
	ini_set('display_errors', 0);
    require_once "../../php/connect.php";
    require_once('./Rconconn.php');

    $login = $_SESSION['login'];
    $servername = $_SESSION['servername'];
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    $host = '';
    $port = 0;
    $password = '';
    $connected = false; 

    $sql = "SELECT * FROM `serversettings` WHERE `servername` = '$servername'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $host = $row['rconhost'];
            $port = $row['rconport'];
            $password = $row['rconpassword'];
        }
    }
    
    $timeout = 3;
    
    use Thedudeguy\Rcon;
    
    $rcon = new Rcon($host, $port, $password, $timeout);
    
    if ($rcon->connect())
    {
        $connected = true;
    }

?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Połączenie RCON</h1>
    <p class="mb-4">W tej sekcji możesz ustawić połączenie RCON dla swojego sklepu. Twój plan obsługuje maksymalnie <b>1</b> połączenie RCON</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">integracja Minecraft-ItemShop</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <form action="./php/rcon.php?todo=savechanges" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="hostname">Host</label>
                                    <input type="text" class="form-control" name="hostname" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="port">Port</label>
                                    <input type="text" class="form-control" id="port" name="port" placeholder="25575">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password">Hasło</label>
                                    <input type="password" class="form-control" id="password" name="password"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Zapisz</button>
                            </div>
                        </div>  
                    </form>
                </div>
                <div class="col-8">
<?php
    if($connected == false){
echo<<<END
    <center>
        <div class="alert alert-danger" role="alert">
        <h5>Połączenie RCON nie zostało ustawione, bądź jest niepoprawne</h5>
        <p>Sprawdz dane RCON i spróbuj połączyć się ponownie</p>
        </div>
        <div class="card">
            <div class="card-body">
                <p>Upewnij się, że <code>enable-rcon:</code> jest ustawione na <code>true</code> w pliku <code>server.properties</code></p>
                <p>Hasło RCON nie może być puste, upewnij się że wypełniłeś pole <code>rcon-password:</code></p>
            </div>
        </div<
    </center>
END;
    }
    else if($connected == true){
echo<<<END
    <center>
        <div class="alert alert-success" role="alert">
        <h5>Połączenie RCON działa bez zarzutów</h5>
        <p>Wygląda na to, że wszystko ustawiłeś poprawnie</p>
        </div>
        <div class="card">
            <div class="card-body">
            <form action="./php/rcon.php?todo=test" method="post">
                <p>Chcesz się upewnić? Wyślij testową komendę na swój serwer</p>
                <button type="submit" class="btn btn-outline-primary">Wyslij testowy komunikat RCON</button>
            </form>
            </div>
        </div>
    </center>
END;       
    }



?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

if($_SESSION['rconcmd'] == true){
    $_SESSION['rconcmd'] = false;
echo<<<END
    <script>
        Swal.fire(
            'Udało się!',
            'Wiadomość testowa została wysłana!',
            'success'
        )
    </script>
END;
}

?>

