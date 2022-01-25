<?php
    session_start();
    if (!isset($_SESSION['logged']))
    {
        header('Location: ./login.php');
        exit();
    }
    $servername = $_SESSION['servername'];
    require_once "../../php/connect.php";
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

    $page = $_SESSION['page'];
    echo $page;
    if(!$page){
        $page = 0;
    }
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Produkty w twoim ItemShopie</h1>
    <p class="mb-4">W tej sekcji widzisz wszystkie twoje produkty</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="?data=addproduct">Kliknij aby dodać nowy</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Typ</th>
                            <th>Produkt</th>
                            <th width="150px">Opis</th>
                            <th width="500px">Komendy RCON</th>
                            <th>Cena</th>
                            <th>Data publikacji</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM itemshop WHERE `servername` = '$servername' ORDER by price DESC LIMIT 10 OFFSET $page";
                            $result = $connect->query($sql);
                            if ($result->num_rows > 0) {
								$pid = 0;
                                while($row = $result->fetch_assoc()) {
									$pid++;
                                    $id = $row['id'];
                                    $type = $row['type'];
                                    $title = $row['title'];
                                    $content = $row['content'];
                                    $price = $row['price'];
                                    $cmd = $row['cmd'];
                                    $date = $row['date'];   
echo<<<END
<tr>
    <td>$pid</td>
    <td>$type</td>
    <td>$title</td>
    <td><a href="#"  data-bs-toggle="modal" data-bs-target="#modal$id">Zobacz opis</a></td>
    <td>$cmd</td>
    <td>$price PLN</td>
    <td>$date</td>
    <td><a href="#" onclick="document.getElementById('deleteform$id').submit();">Usuń</a></td>
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
<?php
     $sql = "SELECT * FROM itemshop WHERE `servername` = '$servername' ORDER by price DESC LIMIT 10 OFFSET $page";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $content = $row['content'];
echo<<<END
<form id="deleteform$id" action='./php/deleteform.php?type=product' method='post'><input value="$id" name="id" style="display:none" /></form>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="modal$id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Opis produktu <b>$title</b></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p class="text-break">$content</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

END;
        }
    }
?>
</div>



