<?php
include("websend/Websend.php");
include("baglanti.php");
error_reporting(0);
session_start();
ob_start();

if(!isset($_SESSION['user_nick']))
{
echo str_repeat("<br>", 8)."<center><h2>Bu sayfayı görebilmek için giriş yapman lazım!</center>";
header("Refresh: 0; url= girisyap.php");
return;
}
include("baglanti.php");

$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
$ayarsor->execute(array(0));
$ayarcek=$ayarsor->fetch();

$kullanicisor = $db->prepare("select * from authme where username=:username");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));
$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="Shortcut Icon" href="img/favicon.ico" type="image/x-icon">

    <title><?php echo $ayarcek['site_title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Squad theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
    
    <!-- =======================================================
        Theme Name: Malware
        Theme URL: Veremeyiz, Batihost.com
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
		Translater: Malware
		Minecraft Version: 1.8,1.9,1.10,1.11
    ======================================================= -->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<!-- Preloader -->
	<div id="preloader">
	  <div id="load"></div>
	</div>

    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <li><a href="indexprofil.php">Ana Sayfa</a></li>
		<li><a href="iletisim.php">İletişim</a></li>
		<li><a href="market.php">Market</a></li>
		<li><a href="cikisyap.php">Çıkış Yap -></a></li>
		<li><a><?php echo "Merhaba, ".$_SESSION['user_nick'];?><li></a>
          </ul>
        </li>
      </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

	<!-- Section: intro -->
    <section id="intro" class="intro">
	
		<div class="slogan">
            <h4>Ödeme başarıyla tamamlandı</h4>
            <?php header("refresh: 5; url=indexprofil.php"); ?>
		</div>
    </section>
	<!-- /Section: intro -->

	

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
                    <div class="credits">
						<a href="https://discord.gg/Qjb56Ku" target="_blank">WebBrick</a>
                    </div>
				</div>
			</div>	
		</div>
	</footer>

    <!-- Core JavaScript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>	
	<script src="js/jquery.scrollTo.js"></script>
	<script src="js/wow.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.js"></script>
    <script src="contactform/contactform.js"></script>
    
</body>

</html>

