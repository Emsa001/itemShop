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

    $login = $_SESSION['login'];
    $servername = $_SESSION['servername'];
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Logi twojego konta</h1>
    <p class="mb-4">Podgląd do wszystkich logowań na twoje konto.</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Udane logowania</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>IP</th>
                                    <th>Adres</th>
                                    <th>Przeglądarka</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM logs WHERE `user` = '$login' ORDER by date DESC";
                                    $result = $connect->query($sql);
                                    if ($result->num_rows > 0) {
                                        $pid = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $date = $row['date'];
                                            $ip = $row['ip'];
                                            $address = $row['address'];
                                            $browser = $row['browser'];
                                    echo<<<END
                                        <tr>
                                            <td>$date</td>
                                            <td>$ip</td>
                                            <td>$address</td>
                                            <td>$browser</td>
                                        </tr>
                                    END;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Zmiany na koncie</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col" width="300px">Data</th>
                                    <th scope="col" width="300px">IP</th>
                                    <th scope="col">Zmiana</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM logs WHERE `user` = '$login' AND `content` is NOT 'successfully logged' ORDER by date";
                                    $result = $connect->query($sql);
                                    if ($result->num_rows > 0) {
                                        $pid = 0;
                                        while($row = $result->fetch_assoc()) {
                                            $date = $row['date'];
                                            $ip = $row['ip'];
                                            $content = $row['content'];
                                    echo<<<END
                                        <tr>
                                            <td>$date</td>
                                            <td>$ip</td>
                                            <td>$content</td>
                                        </tr>
                                    END;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
</div>