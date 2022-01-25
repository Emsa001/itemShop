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

    $theme_color = "#4e73df";
    $sql = "SELECT * FROM serversettings WHERE `servername` = '$servername'";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $theme_color = $row['theme'];
        }
    }

?>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"
></script>

<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet" />

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ustawienia konta</h1>
    <p class="mb-4">W tej sekcji możesz między innymi personalizować wygląd panelu administratora.</p>

    <section>
        <h5>Personalizuj wygląd panelu</h5>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-4" data-mdb-toggle="modal" data-mdb-target="#colorModal">
                <div class="card colorCard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between px-md-1">
                            <div class="align-self-center">
                                <i class="fas fa-circle fa-3x color-<?php echo $theme_color; ?>"></i>
                            </div>
                            <div class="text-end">
                                <h3>Kliknij aby zmienić</h3>
                                <a href="#" class="mb-0 btn-logout">Ustaw Domyślny motyw</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="colorModal" tabadmin="-1" role="dialog" aria-labelledby="colorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="colorModalLabel">Ustaw motyw panelu</h5>
                    <button class="close" type="button" data-mdb-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center">
                    <div class="form-check form-check-inline">
                        <p id="success" class="form-check-label fas fa-circle colorCircle" style="color:#1cc88a;"></p>
                    </div>
                    <div class="form-check form-check-inline">
                        <p id="info" class="form-check-label fas fa-circle colorCircle" style="color:#36b9cc;"></p>
                    </div>
                    <div class="form-check form-check-inline">
                        <p id="warning" class="form-check-label fas fa-circle colorCircle" style="color:#f6c23e;"></p>
                    </div>
                    <div class="form-check form-check-inline">
                        <p id="danger" class="form-check-label fas fa-circle colorCircle" style="color:#e74a3b;"></p>
                    </div>
                    <div class="form-check form-check-inline">
                        <p id="secondary" class="form-check-label fas fa-circle colorCircle" style="color:#b23cfd;"></p>
                    </div>
                    <div class="form-check form-check-inline">
                        <p id="dark" class="form-check-label fas fa-circle colorCircle" style="color:#5a5c69;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-logout').on('click', function() {
		$('<form action="./php/theme.php" method="post"></form>').appendTo('body').submit();
	});

    $('.colorCircle').on('click', function(e) {
		$(`<form action="./php/theme.php" method="post"><input id="color" name="color" value='${e.target.id}'/></form>`).appendTo('body').submit();
	});
</script>