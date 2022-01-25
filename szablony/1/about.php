<?php
    session_start();
	error_reporting(0);
	ini_set('display_errors', 0);
	require_once "./database/connect.php";
    $connect = new mysqli($host, $db_user, $db_password, $db_name);
    mysqli_query($connect, "SET CHARSET utf8");
    mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
?>

<!DOCTYPE html>
<html class="no-js" lang="">

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

    <!-- ================================
        CSS Files
        ================================= -->
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville:400,400i|Open+Sans:400,600,700,800"
        rel="stylesheet">
    <link rel="stylesheet" href="css/themefisher-fonts.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link id="color-changer" rel="stylesheet" href="css/colors/color-0.css">
</head>

<body>

    <div class="preloader">
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
        <div class="loading-mask"></div>
    </div>


    <main class="site-wrapper">
        <div class="pt-table">
            <div class="pt-tablecell page-about relative">
                <!-- .close -->
                <a href="./" class="page-close"><i class="tf-ion-close"></i></a>
                <!-- /.close -->

                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <div class="page-title text-center">
                                <h2>O <span class="primary">nas</span> <span class="title-bg">KADRA</span></h2>
                                <p>Nasz zespół składa się z kilku doświadczonych osób, w którego skład wchodzą nasi
                                    budowniczy, zaawansowani moderatorzy oraz programista.</p>
                            </div>
                        </div>
<?php
    $sql = "SELECT * FROM kadra WHERE `server` = 'RichLife.pl' ORDER by id ASC";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $username = $row['username'];
            $rank = $row['rank'];
            $title = $row['title'];
            $content = $row['content'];
            $building = $row['building'];
            $programming = $row['programming'];
            $english = $row['english'];
            $advertising  = $row['advertising'];
            $image = $row['img'];
            $joined = $row['date'];
            echo<<<END
                        <div class="col-xs-12 col-md-6">
                            <div class="about-author">
                                <figure class="author-thumb">
                                    <img src="$image" alt="">
                                </figure> <!-- /.author-bio -->
                                <div class="author-desc">
                                    <p><b>NickName:</b> $username</p>
                                    <p><b>Ranga:</b> $rank</p>
                                    <p><b>Główna rola</b> $title</p>
                                    <p><b>W administracji od:</b> $joined</p>
                                </div>
                                <!-- /.author-desc -->
                            </div> <!-- /.about-author -->
                            <p>$content</p>
                        </div> <!-- /.col -->

                        <div class="col-xs-12 col-md-6">
                            <div class="section-title clear">
                                <h3>Doświadczenie</h3>
                            </div>
                            <div class="skill-wrapper">
                                <div class="progress clear">
                                    <div class="skill-name">Budowanie</div>
                                    <div class="skill-bar">
                                        <div class="bar"></div>
                                    </div>
                                    <div class="skill-lavel" data-skill-value="$building%"></div>
                                </div> <!-- /.progress -->
                                <div class="progress clear">
                                    <div class="skill-name">Programowanie</div>
                                    <div class="skill-bar">
                                        <div class="bar"></div>
                                    </div>
                                    <div class="skill-lavel" data-skill-value="$programming%"></div>
                                </div> <!-- /.progress -->
                                <div class="progress clear">
                                    <div class="skill-name">Reklamowanie</div>
                                    <div class="skill-bar">
                                        <div class="bar"></div>
                                    </div>
                                    <div class="skill-lavel" data-skill-value="$advertising%"></div>
                                </div> <!-- /.progress -->
                                <div class="progress clear">
                                    <div class="skill-name">Angielski</div>
                                    <div class="skill-bar">
                                        <div class="bar"></div>
                                    </div>
                                    <div class="skill-lavel" data-skill-value="$english%"></div>
                                </div> <!-- /.progress -->
                            </div> <!-- /.skill-wrapper -->
                        </div> <!-- /.col -->
            END;
        }
    }
?>
                    </div> <!-- /.row -->
                </div> <!-- /.container -->
                <nav class="page-nav clear">
                    <div class="container">
                        <div class="flex flex-middle space-between">
                            <span class="prev-page"><a href="index.php" class="link">&larr; Poprzednia
                                    strona</a></span>
                            <span class="copyright hidden-xs">Copyright &copy; 2021 RichCraft.pl</span>
                            <span class="next-page"><a href="services.php" class="link">Następna strona
                                    &rarr;</a></span>
                        </div>
                    </div>
                    <!-- /.page-nav -->
                </nav>
                <!-- /.container -->
            </div> <!-- /.pt-tablecell -->
        </div> <!-- /.pt-table -->
    </main> <!-- /.site-wrapper -->

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/jquery.nicescroll.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery-validation.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>