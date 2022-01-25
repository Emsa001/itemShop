<?php
    session_start();
    if (!isset($_SESSION['logged']))
    {
        header('Location: ./login.php');
        exit();
    }
    
	error_reporting(0);
	ini_set('display_errors', 0);
    $servername = $_SESSION['servername'];
    require_once "../../php/connect.php";
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    $page = $_SESSION['page'];
    if(!$page){
        $page = 0;
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@9/dist/sweetalert2.min.js"></script>
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Płatności</h1>
    <p class="mb-4">W tej sekcji widzisz wszystkie zapisane płatności z itemshopu</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Zakupy:</h6>
            <div class="form-check" style="margin-top:-20px;text-align:right">
                <input class="form-check-input" type="checkbox" value="" id="filter" onChange="filter()">
                <label class="form-check-label" for="flexCheckDefault">
                    Pokaż tylko nowe
                </label>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nickname</th>
                            <th>Zakup</th>
                            <th>Cena</th>
                            <th>Płatność</th>
                            <th>Pin PSC</th>
                            <th>Data</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM userboughts WHERE `deleted` = false AND `servername` = '$servername' ORDER by id DESC LIMIT 50 OFFSET $page";
                            $result = $connect->query($sql);
                            if ($result->num_rows > 0) {
                                $pid = 0;
                                while($row = $result->fetch_assoc()) {
                                    $pid++;
                                    $id = $row['id'];
                                    $nickname = $row['username'];
                                    $item = $row['item'];
                                    $payment = $row['payment'] ? $row['payment'] : "inna";
                                    $price = $row['value'];
                                    $pin = $row['pin'] ? $row['pin'] : "❌";
                                    $date = $row['date'];
                                    $accepted = $row['accepted'];   
                                    if($accepted == true){
                                    echo<<<END
                                        <tr class='accepted' style="background-color:rgba(243, 243, 243, 0.8); text-align:center; ">
                                            <td>$pid</td>
                                            <td>$nickname</td>
                                            <td>$item</td>
                                            <td>$price PLN</td>
                                            <td>$payment</td>
                                            <td>$pin</td>
                                            <td>$date</td>
                                            <td>Zakceptowane / <a href="#" onclick="document.getElementById('deleteform$id').submit();">Usuń</a></td>
                                        </tr>
                                    END;  
                                    }else{
                                    echo<<<END
                                        <tr style="text-align:center;">
                                            <td>$id</td>
                                            <td>$nickname</td>
                                            <td>$item</td>
                                            <td>$price PLN</td>
                                            <td>$payment</td>
                                            <td>$pin</td>
                                            <td>$date</td>
                                            <td><a href="#" onclick="document.getElementById('acceptform$id').submit();">Akceptuj</a> / <a href="#" onclick="document.getElementById('deleteform$id').submit();">Usuń</a></td>
                                        </tr>
                                    END;
                                    }
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    $sql = "SELECT * FROM userboughts WHERE `deleted` = false AND `servername` = '$servername' ORDER by id DESC";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
echo<<<END
<form id="deleteform$id" action='./php/deleteform.php?type=payment' method='post'><input value="$id" name="id" style="display:none" /></form>
<form id="acceptform$id" action='./php/acceptform.php' method='post'><input value="$id" name="id" style="display:none" /></form>
END;
        }
    }

    if($_SESSION['paymentaccepted'] == true){
        $_SESSION['paymentaccepted'] = false;
echo<<<END
<script>
Swal.fire(
    'Płatność zaakceptowana!',
    'Komendy zostały wywołane',
    'success'
  )
</script>
END;
    }
    if($_SESSION['nosuchplayer'] == true){
        $_SESSION['nosuchplayer'] = false;
echo<<<END
<script>
Swal.fire(
    'Wystąpił Błąd!',
    'Takiego gracza nie ma na serwerze',
    'error'
  )
</script>
END;
    }
?>
</div>
<script>
function filter(){
    if(document.getElementById('filter').checked){
        console.log('closing')
        var x = document.getElementsByClassName("accepted");
        for(var i = 0; i < x.length; i++){
            x[i].style.display = "none";
        }
    }else{
        option = false;
        var x = document.getElementsByClassName("accepted");
        for(var i = 0; i < x.length; i++){
            x[i].style.display = "revert";
        }
        console.log('opening')
    }
}

</script>
