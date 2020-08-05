<?php

	include("../Websend.php");
	include("../baglanti.php");
	error_reporting(0);
	session_start();
	ob_start();

	if($_POST){
		$kadi = $_POST["kadi"];
		$sifre = md5($_POST["sifre"]);
		$kullanicisor=$db->prepare("select * from authme where username=:username and password=:password and yetki=:yetki");
		$kullanicisor->execute(array('username' => $kadi,'password' => $sifre, 'yetki' => 1));
		$say=$kullanicisor->rowCount();
		$kullanicibul = $kullanicisor->fetch(PDO::FETCH_ASSOC);

		if($say==1){
			session_start();
			$_SESSION['user_nick'] = $kullanicibul['username'];
			echo "<script>alert('Giriş başarılı, yönlendiriliyorsunuz..')</script>";
			header("refresh: 0;  url=index.php");
			exit;
		} else{
			echo " ";
		} 
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="Shortcut Icon" href="../img/favicon.ico" type="image/x-icon">

    <title>Server İsmi - Admin Giriş</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/animate.css" rel="stylesheet" />
    <!-- Malware theme CSS -->
    <link href="../css/style.css" rel="stylesheet">
	<link href="../color/default.css" rel="stylesheet">
    
    <!-- =======================================================
        Theme Name: Malware
        Theme URL: Veremeyiz, Batihost.com
        Author: BootstrapMade
        Author URL: https://bootstrapmade.com
		Translater: Malware
		Minecraft Version: 1.8,1.9,1.10,1.11
    ======================================================= -->

</head>
	<div id="preloader">
	  <div id="load"></div>
	</div>

	<?php include("../header.php"); ?>

<body style="background-color: #448CBE">
	<center><form method="post">
		<div id="content" style="padding-top: 200px">
		<strong style="color: white">Kullanıcı adı</strong>
		<header>
		<input type="text" minlength="4" maxlength="16" type="text" name="kadi" /><br />
		<header>
		<br><strong style="color: white">Şifre</strong>
		<header>
		<input type="password" minlength="4" maxlength="16" type="text" name="sifre">
		<header>
		<input type="submit" value="Tıkla, giriş yap" style="margin-top: 20px">
		</div>
	</form>
	<div style="margin-top: 230px;">
		<a href="https://discordapp.com/invite/SU2nv4u" target="_blank" style="color: white "><b>Server İsmi</b></a>
	</div>

</center>
</body>
    <!-- Core JavaScript Files -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.easing.min.js"></script>	
	<script src="../js/jquery.scrollTo.js"></script>
	<script src="../js/wow.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../js/custom.js"></script>
    <script src="../contactform/contactform.js"></script>
</html>

 
