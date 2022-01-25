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

   $tmounth = date('m', strtotime('-0 month'));
   $tmearnings = 0;
   $totalearnings = 0;
   $products = 0;
   $orders = 0;
   $o_accepted = 0;

   $st = 0;
   $lut = 0;
   $mrz = 0;
   $kw = 0;

   $maj = 0;
   $czw = 0;
   $lip = 0;
   $sier = 0;
   
   $wrz = 0;
   $paz = 0;
   $lis = 0;
   $gr = 0;   

   $sql = "SELECT * FROM itemshop WHERE `servername` = '$servername'";
   $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products++;
        }
    }

   $sql = "SELECT * FROM userboughts WHERE `deleted` = false AND `servername` = '$servername'";
   $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders++;
            if($row['accepted'] == true){
                $o_accepted++;
                $totalearnings += $row['value'];
                if (date("m", strtotime($row['date'])) == $tmounth){
                    $tmearnings += $row['value'];
                }
                $x = date("m", strtotime($row['date']));
                switch(date("m", strtotime($row['date']))){
                    case 1:
                        $st += $row['value'];
                    break;
                    case 2:
                        $lut += $row['value'];
                    break;
                    case 3:
                        $mrz += $row['value'];
                    break;
                    case 4:
                        $kw += $row['value'];
                    break;
                    case 5:
                        $maj += $row['value'];
                    break;
                    case 6:
                        $czw += $row['value'];
                    break;
                    case 7:
                        $lip += $row['value'];
                    break;
                    case 8:
                        $sier += $row['value'];
                    break;
                    case 9:
                        $wrz += $row['value']; 
                    break;
                    case 10:
                        $paz += $row['value'];
                    break;
                    case 11;
                        $lis += $row['value'];
                    break;
                    case 12:
                        $gr += $row['value'];
                    break;
                }
            }
        }
    }
?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Panel Administratora</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Pobierz PDF</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Zarobki (w tym miesiącu)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $tmearnings; ?> PLN</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Zarobki (Całkowite)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalearnings; ?> PLN</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Produkty
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $products ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Zamówienia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$orders <small>($o_accepted zrealizowane)</small>" ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Raport Sprzedaży ( od <?php echo date("m/d/Y"); ?> )</h6>
                <!--<div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header"></div>
                        <a class="dropdown-item" href="#"></a>
                        <a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"></a>
                    </div>
                </div>-->
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div id="itemCardBody" class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Zamówienia ( od <?php echo date("m/d/Y"); ?> )</h6>
            </div>
            <!-- Card Body -->
            <div id="noOrders" style="display:none;">
                <div class="card">
                    <div class="card-body" style="position:absolute;text-align:center;padding:50px;">
                        <h3 class="card-title">Brak zamówień</h3>
                        <p class="card-text">W twoim sklepie nie ma jeszcze żadnego zamówienia, jak tylko ktoś złoży zamówienie, w tej skecji zobaczysz statystyki zamówień.</p>
                        <i class="far fa-frown" style="font-size:30px;"></i>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?php 
                    if($o_accepted == 0){
                        echo<<<END
                            <span id="ordersLoading" class="spinner-border" style="width: 6rem; height: 6rem;margin-bottom:-150px;margin-left:38%;" role="status"></span>
                        END;
                    }
                ?>
                <div class="chart-pie pt-4 pb-2">
                     <canvas id="myPieChart"></canvas>
                </div>
                <div id="itemLabels" class="mt-4 text-center small">
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="col-lg-6 mb-4">
        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Symulacja Marketingowa <small>(PREMIUM)</small></h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                        src="img/undraw_posting_photo.svg" alt="">
                </div>
                <p>Symulacja marketingowa polega na zasymulowaniu zmian w ekonomii serwera, oraz zapotrzebowania graczy na dany produkt w przypadku zmian w cenie produktu odwołując się do statystyk zakupów z ostatnich miesięcy</p>
            </div>
        </div>

    </div>
</div>
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

<?php 
echo<<<END
    <script>startarea($st,$lut,$mrz,$kw,$maj,$czw,$lip,$sier,$wrz,$paz,$lis,$gr);piechart("RichCraft.pl");</script>
END;
?>

<script>
    setTimeout(() => {
        document.getElementById('ordersLoading') ? document.getElementById('ordersLoading').style.display = "none" : "";
        let itemLabels = document.getElementById("itemLabels");

        items.item.forEach((e) => {
            let span = document.createElement("span");
            span.className = "mr-2";
            span.innerHTML = `<i class="fas fa-circle" style="color: ${e.color};"></i> ${e.item} (${e.quantity})`;
            itemLabels.appendChild(span);
        });
        if(items.item.length == 0){
            let itemCardBody = document.getElementById("noOrders");
            itemCardBody.style.display = "block";
        }
    }, 1000);
</script>