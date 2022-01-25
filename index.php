<?php
  error_reporting(0);
  ini_set('display_errors', 0);
  require_once("./php/connect.php");

	session_start();
  $conn= mysqli_connect($host,$db_user,$db_password,$db_name);
  if (!$conn) {
    die(header("Location: break"));
  }
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <title>BlockDev - Nowoczesny ItemShop</title>
    <link href="./css/style.css" rel="stylesheet" />
    <link href="./css/mobile.css" rel="stylesheet" />
    <link href="./css/assets.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta http-equiv="Cache-control" content="no-cache">

    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"
        async="async"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light crypt">
        <div class="container">
            <a class="navbar-brand me-2" href="./index.php">
                RS
            </a>

            <!-- Toggle button -->
            <button class="navbar-toggler crypt" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarButtonsExample" aria-controls="navbarButtonsExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarButtonsExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item crypt">
                        <a class="nav-link" href="#">Strona główna</a>
                    </li>
                    <li class="nav-item crypt">
                        <a class="nav-link" href="#szablony">Szablony</a>
                    </li>
                    <li class="nav-item crypt">
                        <a class="nav-link" href="#oferta">Oferta</a>
                    </li>
                </ul>
                <!-- Left links -->

                <div class="d-flex align-items-center crypt"> 
										<?php
											$registerbutton = "Panel Admina";
											if (!isset($_SESSION['logged']))
											{
												$registerbutton = "Rejestracja";
												echo<<<END
													<button type="button" class="btn btn-link px-3 me-2" onclick="window.location.href='./php/login.php'">
														Zaloguj się
													</button>
												END;
											}
											echo <<<END
												<button type="button" class="btn btn-primary me-3" onclick="window.location.href='./php/register.php'">
														$registerbutton
												</button>
											END;
										?>
                    <a class="btn btn-dark px-3 crypt" target="_blank" href="https://discord.gg/4nH9FVxMby"
                        role="button"><i class="fab fa-discord"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <header>

        <!-- Background image -->
        <div id="intro-example" class="p-5 text-center bg-image"
            style="background-image: url('https://wallpaperaccess.com/full/37467.jpg');" onclick="changebg(this)">
            <div class="mask" style="background-color: rgba(0, 0, 0, 0.7);">
                <div class="d-flex justify-content-center align-items-center h-100">
                    <div class="text-white">
                        <h1 class="mb-3 animation-start crypt logo">Rich<span>SHOP</span></h1>
                        <h5 class="mb-4">Najlepszy ItemShop dla twojego serwera Minecraft</h5>
                        <a class="btn btn-outline-light btn-lg m-2 crypt" href="#oferta" role="button"
                            rel="nofollow">Zobacz ofertę</a>
                        <a class="btn btn-outline-light btn-lg m-2 crypt" href="#szablony" role="button">Nasze
                            szablony</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Background image -->
    </header>
    <div class="bg-sma crypt">
        <div class="container-fluid shadow crypt">
            <div class="content crypt">
                <div class="row crypt">
                    <div class="col-6 integ">
                        <div class="card text-center crypt">
                            <div class="card-body crypt">
                                <h5 class="card-title crypt">Integracja discord</h5>
                                <p class="card-text crypt">
                                    Specjalnie dla naszych klientów stworzyliśmy zintegrowane z itemshopem boty na
                                    discorda!
                                </p>
                                <a href="#" class="btn btn-dark">Zobacz wszystkie boty</a>
                            </div>
                            <div class="card-footer text-muted"><b>Za darmo</b></div>
                        </div>
                    </div>
                    <div class="col-6 integ">
                        <div class="card text-center">
                            <div class="card-body crypt">
                                <h5 class="card-title">Dodatki</h5>
                                <p class="card-text">
                                    Chcesz ulepszyć swój itemshop? Zobacz jakie dodatki przygotowaliśmy specjalnie dla
                                    ciebie!
                                </p>
                                <a href="#" class="btn btn-dark">Przeglądaj dodatki</a>
                            </div>
                            <div class="card-footer text-muted">już od <b>5 PLN</b></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="szablony" class="container crypt" style="margin-top:50px;text-align: center;">
            <h1 class="animation-starttop"
                style="text-transform: uppercase;margin-bottom:30px;font-weight:900;font-family: 'Lato', sans-serif;">
                Nasze
                szablony</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <div class="col js-scroll-flow crypt classic-col">
                    <div class="card h-100">
                        <div class="classic-img" onclick="window.open('./szablony/3', '_blank');"></div>
                        <div class="card-body">
                            <h5 class="card-title crypt">Classic</h5>
                            <p class="card-text crypt">
                                Klasyczny szablon dla itemshop'u. Nie posiada zaawansowanego rozbudowanego panelu
                                administratora.
                            </p>
                            <a href="./szablony/3" target="_blank"><button type="button" class="btn btn-outline-dark"
                                    data-mdb-ripple-color="dark">
                                    Zobacz
                                </button></a>
                        </div>
                        <div class="card-footer crypt template-footer">
                            <h4 class="text-muted crypt"><b>0 PLN</b></h4>
                            <sup>Jednorazowo</sup><br />
                            <button class="btn btn-dark">Zainstaluj</button>
                        </div>
                    </div>
                </div>
                <div class="col js-scroll-flow crypt">
                    <div class="card h-100">
                        <img src="https://mdbootstrap.com/img/new/standard/city/043.jpg" class="card-img-top"
                            alt="..." />
                        <div class="card-body">
                            <h5 class="card-title">Modern</h5>
                            <p class="card-text">
                                Jest to nowoczesny szablon, przeznaczony dla serwerów, cenionych sobie wygodę oraz
                                przejrzystość.
                            </p>
                            <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark">
                                Zobacz
                            </button>
                        </div>
                        <div class="card-footer crypt template-footer">
                            <h4 class="text-muted"><b>20 PLN</b></h4>
                            <sup>Jednorazowo</sup><br />
                            <form action="./payment/create-checkout-session.php" method="POST" id="paymentf1">
                                <input type="hidden" name="productname" value="Modern">
                                <input type="hidden" id="pmet1" name="pmet" value="">
                                <button type="submit" class="btn btn-dark" style="height:40px;">Karta</button>
                                <img class="btn btn-dark" style="height:40px;"
                                    src="https://bramkiplatnosci.pl/wp-content/uploads/2019/05/Przelewy24_logo-PNG.png"
                                    type="submit" height="20px" onclick="pmethod('paymentf1','pmet1')" />
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col js-scroll-flow">
                    <div class="card h-100">
                        <img src="https://mdbootstrap.com/img/new/standard/city/042.jpg" class="card-img-top"
                            alt="..." />
                        <div class="card-body crypt">
                            <h5 class="card-title">Pro</h5>
                            <p class="card-text">
                                Dla profesjonalnych serwerów minecraft, w pakiet premium wdrążone są większe integracje
                                oraz
                                bardziej
                                zaawansowany panel administracyjny.
                            </p>
                            <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark">
                                Zobacz
                            </button>
                        </div>
                        <div class="card-footer template-footer">
                            <h4 class="text-muted"><b>50 PLN</b></h4>
                            <sup>Jednorazowo</sup><br />
                            <form action="./payment/create-checkout-session.php" method="POST" id="paymentf2">
                                <input type="hidden" name="productname" value="Pro">
                                <input type="hidden" id="pmet2" name="pmet" value="">
                                <button type="submit" class="btn btn-dark" style="height:40px;">Karta</button>
                                <img class="btn btn-dark" style="height:40px;"
                                    src="https://bramkiplatnosci.pl/wp-content/uploads/2019/05/Przelewy24_logo-PNG.png"
                                    type="submit" height="20px" onclick="pmethod('paymentf2','pmet2')" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="oferta" class="img-seperator">
        <div class="separator-text">Postaw na <br /><b>PROFESJONALIZM</b></div>
    </div>
    <div class="bg-smx">
        <div class="container-fluid shadow" style="border-radius:100px;">
            <div class="pricing6 py-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 text-center js-scroll-flow">
                            <h3 class="mb-3" style="text-transform: uppercase;">Nasza oferta</h3>
                            <h6 class="subtitle font-weight-normal">Gwarantujemy <b>100%</b> satysfakcji lub zwrot
                                kosztów
                            </h6>
                        </div>
                    </div>
                    <div class="row mt-4">

                        <div class="col-md-4 crypt">
                            <div class="card card-shadow border-0 mb-4 js-scroll-left crypt">
                                <div class="card-body p-4 crypt">
                                    <div class="d-flex align-items-center crypt">
                                        <h3 class="font-medium m-b-0 crypt">Starter</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 text-center crypt">
                                            <div class="price-box my-3 crypt">
                                                <span class="text-dark display-5">10</span><sup>PLN</sup>
                                                <h6 class="font-weight-light">MIESIĘCZNIE</h6>
                                                <a class="btn btn-info-gradiant border-0 font-14 text-white p-3 btn-block mt-3"
                                                    data-mdb-toggle="modal" data-mdb-target="#starterpmodal"
                                                    href="#">Wybierz
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="starterpmodal" tabindex="-1"
                                            aria-labelledby="starterpmodalLavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="starterpmodalLavel">Starter - <b>10 PLN/ms</b></h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Po zakupie otrzymasz na dane logowania do panelu administratora na podany adres przy płatności.<br />Otrzymasz również instrukcję logowania oraz instalacji szablonów.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="./payment/create-checkout-session.php"
                                                            method="POST" id="paymentf3">
                                                            <input type="hidden" name="productname" value="Starter">
                                                            <input type="hidden" id="pmet3" name="pmet" value="">
                                                            <button type="submit" class="btn btn-dark"
                                                                style="height:40px;">Karta</button>
                                                            <img class="btn btn-dark" style="height:40px;"
                                                                src="https://bramkiplatnosci.pl/wp-content/uploads/2019/05/Przelewy24_logo-PNG.png"
                                                                type="submit" height="20px" onclick="pmethod('paymentf3','pmet3')" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 align-self-center">
                                            <ul class="list-inline pl-3 font-14 font-weight-medium text-dark crypt">
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Pomoc techniczna
                                                    </span>
                                                </li>
                                                <li class="py-2"><i class="fas fa-times"></i> <span>Integracja
                                                        Discord</span></li>
                                                <li class="py-2"><i class="fas fa-times"></i> <span>Dodatki
                                                        Premium</span>
                                                </li>
                                                <li class="py-2"><b>1</b> <span> </span>Połączenie RCON</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 crypt">
                            <div class="card card-shadow border-0 mb-4 js-scroll-bottom">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <h3 class="font-weight-medium mb-0" style="margin-right: 10px;">Premium</h3>
                                        <div class="ml-auto"><span
                                                class="badge badge-danger font-weight-normal p-2">TOP</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 text-center">
                                            <div class="price-box my-3">
                                                <span class="text-dark display-5 crypt">30 </span><sup>PLN</sup>
                                                <h6 class="font-weight-light">MIESIĘCZNIE</h6>
                                                <a class="btn btn-info-gradiant border-0 font-14 text-white p-3 btn-block mt-3"
                                                    data-mdb-toggle="modal" data-mdb-target="#premiummodal"
                                                    href="#">Wybierz
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="premiummodal" tabindex="-1"
                                            aria-labelledby="premiummodalLavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="premiummodalLavel">Premium - <b>30 PLN/ms</b></h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Po zakupie otrzymasz na dane logowania do panelu administratora na podany adres przy płatności.<br />Otrzymasz również instrukcję logowania oraz instalacji szablonów.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="./payment/create-checkout-session.php"
                                                            method="POST" id="paymentf4">
                                                            <input type="hidden" name="productname" value="Premium">
                                                            <input type="hidden" id="pmet4" name="pmet" value="">
                                                            <button type="submit" class="btn btn-dark"
                                                                style="height:40px;">Karta</button>
                                                            <img class="btn btn-dark" style="height:40px;"
                                                                src="https://bramkiplatnosci.pl/wp-content/uploads/2019/05/Przelewy24_logo-PNG.png"
                                                                type="submit" height="20px" onclick="pmethod('paymentf4','pmet4')" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 align-self-center crypt">
                                            <ul class="list-inline pl-3 font-14 font-weight-medium text-dark">
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Pomoc techniczna
                                                    </span>
                                                </li>
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Integracja
                                                        Discord</span></li>
                                                <li class="py-2"><i class="fas fa-times"></i> <span>Dodatki
                                                        Premium</span>
                                                </li>
                                                <li class="py-2"><b>3</b> <span> </span>Połączeń RCON</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 crypt">
                            <div class="card card-shadow border-0 mb-4 js-scroll-right">
                                <div class="card-body p-4">
                                    <div class="d-flex align-items-center">
                                        <h3 class="font-medium m-b-0">Business</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 text-center">
                                            <div class="price-box my-3">
                                                <span class="text-dark display-5">100 </span><sup>PLN</sup>
                                                <h6 class="font-weight-light">MIESIĘCZNIE</h6>
                                                <a class="btn btn-info-gradiant border-0 font-14 text-white p-3 btn-block mt-3"
                                                    data-mdb-toggle="modal" data-mdb-target="#businesspmodal"
                                                    href="#">Wybierz
                                                </a>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="businesspmodal" tabindex="-1"
                                            aria-labelledby="businessmodalLavel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="businessmodalLavel">Business - <b>100 PLN/ms</b></h5>
                                                        <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Po zakupie otrzymasz na dane logowania do panelu administratora na podany adres przy płatności.<br />Otrzymasz również instrukcję logowania oraz instalacji szablonów.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="./payment/create-checkout-session.php"
                                                            method="POST" id="paymentf5">
                                                            <input type="hidden" name="productname" value="Business">
                                                            <input type="hidden" id="pmet5" name="pmet" value="">
                                                            <button type="submit" class="btn btn-dark"
                                                                style="height:40px;">Karta</button>
                                                            <img class="btn btn-dark" style="height:40px;"
                                                                src="https://bramkiplatnosci.pl/wp-content/uploads/2019/05/Przelewy24_logo-PNG.png"
                                                                type="submit" height="20px" onclick="pmethod('paymentf5','pmet5')" />
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 align-self-center">
                                            <ul class="list-inline pl-3 font-14 font-weight-medium text-dark">
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Pomoc techniczna
                                                    </span>
                                                </li>
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Integracja
                                                        Discord</span></li>
                                                <li class="py-2"><i class="fas fa-check"></i> <span>Dodatki
                                                        Premium</span>
                                                </li>
                                                <li class="py-2"><b>5</b> <span> </span>Połączeń RCON</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="background-s js-scroll crypt">
            <h3>Nie czekaj<br />Stwórz swój <b>itemshop</b> już dziś</h3>
        </div>

        <div class="shadow crypt" style="border-radius: 100px">
            <div class="content" style="margin-top:20px;">
                <div class="partnerzy">
                    <h1 style="margin-bottom:50px">Nasi partnerzy</h1>

                    <!-- Carousel wrapper -->
                    <div id="carouselBasicExample" class="carousel slide" data-mdb-ride="carousel"
                        data-mdb-interval="5000" data-mdb-pause="hover">

                        <!-- Inner -->
                        <div class="carousel-inner">
                            <?php
                                $sql = "SELECT * FROM partnerzy";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    $i = 0;
                                    $active = "active";
                                    while($row = $result->fetch_assoc()) {
                                        $i++;
                                        $name = $row['name'];
                                        $img = $row['img'];
                                        $link = $row['link'];
                                        if($i == 1){
                                            echo '<div class="carousel-item '.$active.'"><div class="row">';
                                            $active = "";
                                        }
                                        echo<<<END
                                                    <div class="col-4">
                                                        <a href="$link" target="_blank">
                                                            <div class="card carusel-card">
                                                                <img src="$img" class="card-img-top" alt="$name" />
                                                                <div class="card-body">
                                                                    <p>$name</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                        END;
                                        if($row['id']%3 == 0){
                                            $i = 0;
                                            echo "</div></div>";
                                        }
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-contact100 crypt">
                <div class="wrap-contact100 crypt">
                    <form class="contact100-form validate-form js-scroll-bottom crypt">
                        <span class="contact100-form-title crypt">
                            Zostań naszym partnerem
                        </span>

                        <div class="wrap-input100 validate-input crypt" data-validate="Uzupełnij swoje dane">
                            <input class="input100" type="text" name="name" placeholder="Imię i Nazwisko">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input crypt" data-validate="Napisz swój email">
                            <input class="input100" type="text" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input crypt" data-validate="To pole nie może byc puste">
                            <textarea class="input100" name="message" placeholder="Wiadomość"></textarea>
                            <span class="focus-input100"></span>
                        </div>

                        <div class="container-contact100-form-btn crypt">
                            <button class="contact100-form-btn">
                                Wyślij
                            </button>
                        </div>
                    </form>

                    <div class="contact100-more crypt">
                        Lub napisz do nasz na <a href="https://discord.gg/4nH9FVxMby" target="_blank"
                            class="contact100-more-highlight">discordzie</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <footer class="bg-dark text-center text-white text-lg-start crypt" style="margin-top:30px;">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            <a href="./regulamin.pdf" target="_blank" style="text-align:center">Regulamin<a><br />
                    © 2021 Wszelkie prawa zastrzeżone:
                    <a class="text-white" href="./index"><b>RichShop.pl</b></a>
        </div>
        <!-- Copyright -->
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>

    <script>
    function pmethod(id,idinmpt) {
        document.getElementById(idinmpt).value = "przelewy24";
        document.getElementById(id).submit();
    }
    </script>
    <script src='./js/graph.js'></script>


    <?php $conn->close(); ?>
</body>
</html>