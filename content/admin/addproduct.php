<?php
    session_start();

    if (!isset($_SESSION['logged']))
	{
		header('Location: ./login.php');
		exit();
	}

    require_once "../../php/connect.php";
    // Create connection
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dodaj nowy przedmiot do ItemShopu</h1>
    <p class="mb-4">W tej sekcji możesz dodać nowy przedmiot do swojego sklepu</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="?data=products">Kliknij aby zobaczyć wszystkie produkty</a></h6>
        </div>
        <div class="card-body">
            <form action="./php/additem.php" method="post">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="itemname">Typ</label>
                            <select class="form-select" aria-label="Default select example" name="itemtype">
                                <option selected>Ranga</option>
                                <option value="1">Item</option>
                                <option value="2">Inne</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="itemname">Nazwa przedmiotu</label>
                            <input type="text" class="form-control" id="itemname" name="itemname" placeholder="VIP">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="itemprice">Cena przedmiotu</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">PLN</span>
                                <input type="number" class="form-control" id="itemprice" name="itemprice" aria-label="Cena" placeholder="35" onkeypress='return event.charCode >= 48 && event.charCode <= 57' />
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="itemdes">Opisz przedmiot</label>
                            <textarea class="form-control" id="itemdes" name="itemdes" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="itemcmd">Komeda RCON</label><br />
                            <small>Zmienne: {player} {item} {price}</small>
                            <textarea class="form-control" id="itemcmd" name="itemcmd" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Dodaj przedmiot</button>
                    </div>
                </div>  
            </form>
        </div>
    </div>
</div>