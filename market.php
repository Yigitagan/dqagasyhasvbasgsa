<?php
include("Websend.php");
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

$host=$ayarcek['websend_sayisalip'];
$pass=$ayarcek['websend_sifre'];
$port=$ayarcek['websend_port'];

$kullanicisor = $db->prepare("select * from authme where username=:username");
$kullanicisor->execute(array('username' => $_SESSION['user_nick']));
$kullanici = $kullanicisor->fetch(PDO::FETCH_ASSOC);

if ($_GET['ual']=="ok") {

	$urunsor=$db->prepare("SELECT * FROM urunler WHERE urun_id=:id");
	$urunsor->execute(array('id' => $_GET['uid']));
	$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

	if ($kullanici['kredi'] >= $uruncek['urun_fiyat']) {

		$ykredi= $kullanici['kredi'] - $uruncek['urun_fiyat'];

		$duzenle=$db->prepare("UPDATE authme SET kredi=:kredi WHERE id=:id");
		$azalt=$duzenle->execute(array('kredi' => $ykredi, 'id' => $kullanici['id']));

		$ekle=$db->prepare("INSERT INTO alinanurun SET urun_isim=:urun_isim, username=:username, urun_fiyat=:urun_fiyat");
		$yeniekle=$ekle->execute(array('urun_isim' => $uruncek['urun_isim'], 'username' => $kullanici['username'], 'urun_fiyat' => $uruncek['urun_fiyat']));

		if ($yeniekle) {
            $komut=$uruncek['urun_komut'];
            $ws = new Websend($host,$pass,$port);

            if($ws->connect()){
                $ws->doCommandAsConsole($komut);
                echo "<script>alert('Başarıyla ürün satın alındı')</script>";
            }else{
                echo "<script>alert('Herhangi bir hata sonucu ürün verilemedi, Lütfen yetkili birine bildiriniz')</script>";
            }
            $ws->disconnect();

			header("refresh: 0; url=indexprofil.php");
		} else {
			echo "<script>alert('Ürün satın alınamadı')</script>";
			header("refresh: 0; url=indexprofil.php");
		}
	}
	else
	{
		echo "<script>alert('Yetersiz kredi')</script>";
		header("refresh: 0; url=indexprofil.php");
	}
}
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
    <script type="text/javascript">

    function ShowConfirm() {
        var confirmation = confirm("Satın almak istediğinize emin misiniz?");
        
        return confirmation;
    };

  </script>
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
        <li class="active"><a href="index.php">Ana Sayfa</a></li>
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
            <h4 style="color: orange">Market aşağıda</h4>
					<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="col-md-9 col-lg-9" style="margin-left: 180px; background-color: white; border-radius: 25px">
                        <?php
                        $market = $db->prepare("SELECT count(*) FROM urunler");
                        $market->execute();
                        $say = $market->fetchColumn();
                        if ($say==0) {?> Market'e hiç ürün eklenmemiş <?php }else{

                            $urunsor=$db->prepare("SELECT * FROM urunler order by urun_id");
                            $urunsor->execute();
                            while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>
							<div class="col-md-3 col-lg-3" style=" background-color: white; margin-left: 17px; margin-top: 15px; margin-bottom: 15px; width: 250px; height: 85px; border-radius: 10px; box-shadow: 0 4px 8px 0 rgba(0,0,0,0.6);">
								<img style="margin-left: -150px; border-radius: 5px 5px 0 0;<?php if ($uruncek['urun_resimurl'] == null) { echo "margin-top: 10px"; } ?>" src="<?php if( $uruncek['urun_resimurl'] != null){ echo $uruncek['urun_resimurl']; }elseif(!file_exists($uruncek['urun_resimurl'])){ echo "img/urunbos.jpg"; }?>" width="40%">
								<h5 style="margin-left: 100px; margin-top: -65px"><?php echo $uruncek['urun_isim']; ?></h5><br>
                                <h6 style="margin-left: 100px; margin-top: -45px">Fiyat: <?php echo $uruncek['urun_fiyat']; ?></h6>
                                <br>
								<a href="market.php?uid=<?php echo $uruncek['urun_id']; ?>&ual=ok">
									<button class="btn btn-primary btn-xl" style="margin-left: 100px; margin-top: -74px; border-radius: 5px" onclick="return ShowConfirm();">Ürünü al</button>
								</a>
							</div>
                        <?php
                            } 
                        }
                    ?>
		</div>
    </section>
	<!-- /Section: intro -->

	

	<footer>

					</div>
				</div>
			</div>
            <br><br>
            <div class="credits">
                <center>
                <a href="https://discord.gg/SU2nv4u" target="_blank">Server İsmi</a>
                </center>
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