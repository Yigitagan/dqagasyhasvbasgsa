<?php

	include("Websend.php");
	include("baglanti.php");
	error_reporting(0);
	session_start();
	ob_start();
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="Shortcut Icon" href="img/favicon.ico" type="image/x-icon">

    <title>BATIHOST</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" />
    <!-- Malware theme CSS -->
    <link href="css/style.css" rel="stylesheet">
	<link href="color/default.css" rel="stylesheet">
    
    <!-- =======================================================
        Theme Name: WebBrick
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
		<li><a href="index.php">Geri git -></a></li>
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
			<h2>Şifre değiştir </h2>
			<h4>Aşağı kaydırın, şifre değiştirme yerini göreceksiniz.</h4>
		</div>
    </section>
	<!-- /Section: intro -->

	 

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="wow shake" data-wow-delay="0.4s">
					<div class="page-scroll marginbot-30">
						<a href="#intro" id="totop" class="btn btn-circle">
							<i class="fa fa-angle-double-up animated"></i>
						</a>
					</div>
					</div>
<html>
	<?php include("header.php"); ?>
<body>
		<div id="content">
		<?php 	
		if(isset($_POST['sifredegis'])){

		$kadi = htmlspecialchars($_POST["kadi"]);
		$epass=$_POST["esifre"];
		$ypass = $_POST["ysifre"];
		$ypass2 = $_POST["ysifre2"];
		$e_password=md5($epass);
		$kullanicisor=$db->prepare("select * from authme where password=:password");
		$kullanicisor->execute(array('password' => $e_password));
		$say=$kullanicisor->rowCount();
		if($say==0)
		{
			echo "<script>alert('Eski şifre yanlış')</script>";
		}
		else
		{
			if($ypass != $ypass2)
			{
				echo "Şifreler uyuşmuyor";
			}
			else
			{
				if(strlen($ypass)<=3)
				{
					echo "Şifreniz 4 karakterden uzun olmalı";
				}
				else
				{
					$sifre = md5($ypass);
					$kullanicikaydet=$db->prepare("UPDATE authme SET password=:password WHERE username=:username");

				
					$insert=$kullanicikaydet->execute(array(
						'password' => $sifre, 'username' => $_SESSION['user_nick']));
					if($insert){
						session_destroy();
						echo "<script>alert('Başarıyla şifre değiştirldi, şifreniz değiştirldiği için çıkış yapıldı.')</script>";
						header("refresh: 0;  url=index.php");
					}
					else
					{
						echo "<script>alert('Şifreniz değiştirilemedi')</script>";
					}
				}
			}
		}
	} ?>
			<form method="post" action="">
			<br>
			<strong>Kullanıcı adın: <?php echo $_SESSION['user_nick']; ?></strong>
			<br><br>
			<strong>Eski şifre</strong> 
			<br>
			<input type="password" minlength="4" maxlength="16" type="text" name="esifre" />
			<br><br>
			<strong>Yeni Şifre</strong> 
			<br>
			<input type="password" minlength="4" maxlength="16" type="text" name="ysifre" />
			<br><br>
			<strong>Yeni Şifre Tekrar</strong>
			<br>
			<input type="password" minlength="4" maxlength="16" type="text" name="ysifre2" />
			<br>
			<input type="submit" name="sifredegis" value="Tıkla, şifre değiştir" style="margin-top: 15px">
			<br><br>
			</form>
		</div>
                    <div class="credits">
                        <!-- 
                            All the links in the footer should remain intact. 
                            You can delete the links only if you purchased the pro version.
                            Licensing information: https://bootstrapmade.com/license/
                            Purchase the pro version with working PHP/AJAX contact form: Veremeyiz,
                        -->
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

 
