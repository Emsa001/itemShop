<?php
	require_once "./database/connect.php";
    $connect = @new mysqli($host, $db_user, $db_password, $db_name);
	mysqli_query($connect, "SET CHARSET utf8");
	mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	if (!$connect) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
<!DOCTYPE html>
<html class="no-js">

<head>
    <!-- meta charset -->
    <meta charset="utf-8">
    <!-- site title -->
    <title>RichLife - Serwer Reallife</title>
    <!-- meta description -->
    <meta name="description" content="">
    <!-- mobile viwport meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- fevicon -->
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 

    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i|Open+Sans:400,600,700,800"
        rel="stylesheet">
    <link rel="stylesheet" href="css/themefisher-fonts.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link id="color-changer" rel="stylesheet" href="css/colors/color-0.css">

    <style>
      .page-footer{
        background-color: rgb(76, 150, 219);
        color:#fff;
        font-family: 'Montserrat', sans-serif;
      }
      .itemshop-item{
          cursor: pointer;
      }
    </style>

</head>

<body>

    <div class="preloader">
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
    </div>

    <section class="site-wrapper">
        <div class="pt-table">
            <div class="pt-tablecell page-services relative">
                <a href="./" class="page-close"><i class="tf-ion-close"></i></a>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-lg-offset-1 col-lg-10">
                            <div class="page-title text-center">
                                <h2>ItemShop <span class="primary">RichLife</span> <span
                                        class="title-bg">RichLife</span>
                                </h2>
                                <p>Chcesz ominąć proces zarabiania, lub przyśpieszyć swój rozwój na serwerze? Idealnie trafiłeś! Oferujemy ci różne doładowania, które pomogą ci w rozgrywce!</p>
                            </div>
                            <div class="hexagon-menu services clear">
                                <?php

$sql = "SELECT * FROM itemshop WHERE `servername` = 'RichLife.pl' ORDER by id ASC";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $type = $row['type'];
        $title = $row['title'];
        $content = $row['content'];
        $full_content = $row['full_content'];
        $price = $row['price'];
        $bought = $row['bought'];
        if($row["hidden"] == true){
            echo<<<END
                <div class="itemshop-item" onclick="$('#item$id').modal('show');" style="visibility:hidden">
                    <div class="service-hex"  style="margin-bottom:50px;">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 372 424.5" style="enable-background:new 0 0 372 424.5;"
                            xml:space="preserve">
                            <g>
                                <polygon class="st0"
                                    points="359.9,314.1 186.9,414 14,314.1 14,114.4 186.9,14.6 359.9,114.4" />
                                <polygon class="st1"
                                    points="331.2,297.6 186.9,380.9 42.6,297.6 42.6,131 186.9,47.6 331.2,131" />
                            </g>
                        </svg>

                        <div class="content">
                            <div class="icon">
                                <i class="et-line icon-lightbulb"></i>
                            </div>
                            <h4>$title</h4>
                            <p>$content</p>
                            <h43>$price PLN</h4>
                        </div>
                    </div>
                </div>
            END;
        }else{
            echo<<<END
                <div class="itemshop-item" onclick="$('#item$id').modal('show');">
                    <div class="service-hex"  style="margin-bottom:50px;">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 372 424.5" style="enable-background:new 0 0 372 424.5;"
                            xml:space="preserve">
                            <g>
                                <polygon class="st0"
                                    points="359.9,314.1 186.9,414 14,314.1 14,114.4 186.9,14.6 359.9,114.4" />
                                <polygon class="st1"
                                    points="331.2,297.6 186.9,380.9 42.6,297.6 42.6,131 186.9,47.6 331.2,131" />
                            </g>
                        </svg>

                        <div class="content">
                            <div class="icon">
                                <i class="et-line icon-lightbulb"></i>
                            </div>
                            <h4>$title</h4>
                            <p>$content</p>
                            <h43>$price PLN</h4>
                        </div>
                    </div>
                </div>
            
                <!-- Modal -->
                    <div class="modal bd-example-modal-lg fade" id="item$id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form class="row g-3" action="./database/payment.php" method="post" style="justify-content: center;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title" id="exampleModalLabel">$title - $price PLN</h2z>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="form-control" required name="productid" value="$id" style="display:none">
                                        <input type="text" class="form-control" required name="price" value="$price" style="display:none">
                                        <input type="text" class="form-control" required name="item" value="$title" style="display:none">
                                        <div class="col-auto">
                                            <label>NickName:</label>
                                            <input type="text" class="form-control" required name="nickname">
                                        </div>
                                        <div class="col-auto">
                                            <label>Pin PSC</label>
                                            <input type="text" class="form-control" required name="pscpin" maxlength="16" minlength="16" onkeyup="this.value=this.value.replace(/[^\d]/,'');this.maxLength = 16">
                                        </div>
                                        <hr />
                                        <div class="content-long" style="text-align:center">
                                            <p>$full_content</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <p style="float:left;margin-left:auto;">Kupiło: <b>$bought</b> osób</p>
                                        <button type="submit" class="btn btn-primary">Zapłać</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            END;
        }
    }
}
?>
                            </div>

                        </div> <!-- /.col-xs-12 -->

                    </div> <!-- /.row -->
                </div> <!-- /.container -->

            </div> <!-- /.pt-tablecell -->
        </div> <!-- /.pt-table -->
    </section> <!-- /.site-wrapper -->

    <footer class="page-footer">
        <div class="footer-copyright text-center py-3">© 2021 Wszelkie prawa zastrzeżone:
            <a href="https://richshop.pl/"> RichShop.pl</a>
        </div>
    </footer>

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery-validation.min.js"></script>
    <script src="js/form.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>