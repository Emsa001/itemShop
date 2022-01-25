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
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
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
            <div class="pt-tablecell page-works relative">
                <!-- .close -->
                <a href="./" class="page-close"><i class="tf-ion-close"> </i></a>
                <!-- /.close -->

                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <div class="page-title text-center">
                                <h2>Reklamy <span class="primary">firm</span> <span class="title-bg">Richlife</span></h2>
                                <p>Możesz wykupić reklamę swojej firmy, po zakupie subskypcji twoja firma zostanie zareklamowana na naszym discordzie oraz na tej stronie.<br /><br />koszt reklamy zależy od wielkości firmy, można zapłacić pieniędzy wirtualnymi jak i prawdziwymi.</p>
                            </div>
                        </div>
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <ul class="filter list-inline">
                                <li><a href="#" class="active" data-filter="*">Wszystkie</a></li>
                                <li><a href="#" data-filter=".builds">Firmy Budowalne</a></li>
                                <li><a href="#" data-filter=".techno">Firmy Technologiczne</a></li>
                                <li><a href="#" data-filter=".restaurants">Restauracje</a></li>
                            </ul>
                        </div>
                    </div>
                    <?php
    $sql = "SELECT * FROM firms ORDER by id ASC";
    $result = $connect->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $owner = $row['owner'];
            $img = $row['img'];
            $tags = $row['tags'];
            echo<<<END
                    <div class="row isotope-gutter">
                        <div class="col-xs-12 col-sm-6 col-md-4 $tags">
                            <figure class="works-item">
                                <img src="$img" alt="?">
                                <div class="overlay"></div>
                                <figcaption class="works-inner">
                                    <h4>$title</h4>
                                    <p>$tags</p>
                                    <small>by $owner</small>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
            END;
        }
    }

?>
                    </div> <!-- /.row -->
                </div> <!-- /.container -->

                <nav class="page-nav clear">
                    <div class="container">
                        <div class="flex flex-middle space-between">
                            <span class="prev-page"><a href="itemshop.php" class="link">&larr; Następna strona</a></span>
                            <span class="copyright hidden-xs">Copyright &copy; 2021 RichCraft.pl</span>
                            <span class="next-page"><a href="index.php" class="link">Poprzednia strona &rarr;</a></span>
                        </div>
                    </div>
                    <!-- /.page-nav -->
                </nav>
                <!-- /.container -->

            </div> <!-- /.pt-tablecell -->
        </div> <!-- /.pt-table -->
    </main> <!-- /.site-wrapper -->

    <!-- ================================
        JavaScript Libraries
        ================================= -->
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