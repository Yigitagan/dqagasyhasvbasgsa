<?php

	include("Websend.php");
	include("baglanti.php");
	error_reporting(0);
	session_start();
	ob_start();
	
	if($_POST){
		$kadi = htmlspecialchars($_POST["kadi"]);
		$pass = $_POST["sifre"];
		if(strlen($kadi)>=4 && strlen($pass)>=4)
		{
			$sifre = md5($pass);
			$sorgu = $db->prepare("insert into authme (username, password, ip, lastlogin, x, y, z) values ('$kadi', '$sifre', '0', 'null', '0', '0', '0')");
			$sorgu->execute();
			
			if($sorgu){
				$_SESSION['user_nick'] = $kadi;
				echo "<script>alert('Başarıyla kayıt oldunuz, üst taraftaki geri git butonuna tıklayarak ana sayfaya gidin, ondan sonra giriş yap butonuna basarak giriş yapın.')</script>";
				header("refresh: 0;  url=indexprofil.php");
			} else {
				echo "<script>alert('Kullanıcı adı daha önce kayıtlanmış.')</script>";
			}
		}
		else
		{
			echo "<script>('Kullanıcı adı ve şifre boş olmamalı')</script>";
		}
	}
?>

<?php

	$ayarsor=$db->prepare("SELECT * FROM ayar where ayar_id = ?");
	$ayarsor->execute(array(0));
	$ayarcek=$ayarsor->fetch();

	if($_POST){
		$kadi = $_POST["kadi"];
		$sifre = md5($_POST["sifre"]);
		$kullanicisor=$db->prepare("select * from authme where username=:username and password=:password");
		$kullanicisor->execute(array('username' => $kadi,'password' => $sifre));
		$say=$kullanicisor->rowCount();
		$kullanicibul = $kullanicisor->fetch(PDO::FETCH_ASSOC);

		if($say==1){
			$_SESSION['user_nick'] = $kullanicibul['username'];
			echo "<script>alert('Giriş başarılı, yönlendiriliyorsunuz..')</script>";
			header("refresh: 0;  url=indexprofil.php");
			exit;
		} else{
			echo " ";
		} 
	}
?>






<!DOCTYPE html>
<html lang="en-US">
    <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GBF123 &#8211; server.ismi |</title>
	<link rel='stylesheet' id='layerslider-css'  href='https://kola2.craft.tc/content/plugins/LayerSlider/static/css/layerslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='ls-google-fonts-css'  href='https://fonts.googleapis.com/css?family=Lato:100,300,regular,700,900%7COpen+Sans:300%7CIndie+Flower:regular%7COswald:300,regular,700&#038;subset=latin%2Clatin-ext' type='text/css' media='all' />
	<link rel='stylesheet' id='bbp-default-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/css/bbpress.css' type='text/css' media='screen' />
	<link rel='stylesheet' id='contact-form-7-css'  href='https://kola2.craft.tc/content/plugins/contact-form-7/includes/css/styles.css' type='text/css' media='all' />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel='stylesheet' id='style-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/style.css' type='text/css' media='all' />
	<link rel='stylesheet' id='fonts-css'  href='//fonts.googleapis.com/css?family=Oswald%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic++++++++%7CTitillium+Web%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic++++++++%7CRoboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic++++++++%7COpen+Sans%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic++++++++%7CExo%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;ver=1.0.0' type='text/css' media='all' />
	<link rel='stylesheet' id='custom-style1-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/css/jquery.fancybox.css' type='text/css' media='all' />
	<link rel='stylesheet' id='custom-style2-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/css/jquery.bxslider.css' type='text/css' media='all' />
	<link rel='stylesheet' id='animatecss-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/css/animate.css' type='text/css' media='all' />
	<link rel='stylesheet' id='owl-style-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/addons/wp-owl-carousel/owl-carousel/owl.carousel.css' type='text/css' media='all' />
	<link rel='stylesheet' id='owl-theme-css'  href='https://kola2.craft.tc/content/themes/oguzhanpw/addons/wp-owl-carousel/owl-carousel/owl.theme.css' type='text/css' media='all' />
	<link rel='stylesheet' id='js_composer_front-css'  href='https://kola2.craft.tc/content/plugins/js_composer/assets/css/js_composer.min.css' type='text/css' media='all' />

	<link rel='stylesheet' id='ubermenu-css'  href='https://kola2.craft.tc/content/plugins/ubermenu/pro/assets/css/ubermenu.min.css' type='text/css' media='all' />
	<link rel='stylesheet' id='ubermenu-clean-white-css'  href='https://kola2.craft.tc/content/plugins/ubermenu/pro/assets/css/skins/cleanwhite.css' type='text/css' media='all' />
	<link rel='stylesheet' id='ubermenu-font-awesome-css'  href='https://kola2.craft.tc/content/plugins/ubermenu/assets/css/fontawesome/css/font-awesome.min.css' type='text/css' media='all' />
	 
	 <script type='text/javascript' src='https://kola2.craft.tc/includes/js/jquery/jquery.js'></script>  
	<style id="ubermenu-custom-generated-css">
		/** UberMenu Custom Menu Item Styles (Menu Item Settings) **/
		/* 2227 */  .ubermenu .ubermenu-submenu.ubermenu-submenu-id-2227 { background-image:url(https://kola2.craft.tc/content/uploads/2015/10/menu-bg.jpg); background-repeat:no-repeat; background-position:bottom right; background-size:auto; }
		/* 3142 */  .ubermenu .ubermenu-submenu.ubermenu-submenu-id-3142 { background-image:url(https://kola2.craft.tc/content/uploads/2015/10/bgm2.jpg); background-repeat:no-repeat; background-position:bottom right; background-size:auto; }

		/* Status: Loaded from Transient */
	</style>
	
	 <!-- google -->
		 <!-- google -->
	
		<script>
		  (function(d) {
			function getData() {
			  var xhr = new XMLHttpRequest();
			  xhr.onreadystatechange = function() {
				if (xhr.status == 200 && xhr.readyState == 4) {
				  var data = JSON.parse(xhr.responseText);
				  var status = data["status"];
				  var durum = d.getElementById("durum");
				  var online = data["players"]["online"];
				  var max = data["players"]["max"];
				  d.getElementById("omax").innerHTML = online;
				  d.getElementById("omax2").innerHTML = max;
				}
			  }
			  xhr.open("GET", "https://mcapi.ca/query/kola2.batihost.com/players", true);
			  xhr.send();
			}
			getData();
			setInterval(function() {
			  getData();
			}, 1000);
		   
		  })(document);
		</script>
		
		<!-- Kaliteli Kod Yayıncısı & Kaynak : http://www.webkodu.com -->
<!-- WebKodu.com / Artık Herşey Tek Çatı Altında : http://www.webkodu.com -->
<script type="text/javascript">

var colour="#000000";
var sparkles=120;


var x=ox=400;
var y=oy=300;
var swide=800;
var shigh=600;
var sleft=sdown=0;
var tiny=new Array();
var star=new Array();
var starv=new Array();
var starx=new Array();
var stary=new Array();
var tinyx=new Array();
var tinyy=new Array();
var tinyv=new Array();

window.onload=function() { if (document.getElementById) {
  var i, rats, rlef, rdow;
  for (var i=0; i<sparkles; i++) {
    var rats=createDiv(3, 3);
    rats.style.visibility="hidden";
    document.body.appendChild(tiny[i]=rats);
    starv[i]=0;
    tinyv[i]=0;
    var rats=createDiv(5, 5);
    rats.style.backgroundColor="transparent";
    rats.style.visibility="hidden";
    var rlef=createDiv(1, 5);
    var rdow=createDiv(5, 1);
    rats.appendChild(rlef);
    rats.appendChild(rdow);
    rlef.style.top="2px";
    rlef.style.left="0px";
    rdow.style.top="0px";
    rdow.style.left="2px";
    document.body.appendChild(star[i]=rats);
  }
  set_width();
  sparkle();
}}

function sparkle() {
  var c;
  if (x!=ox || y!=oy) {
    ox=x;
    oy=y;
    for (c=0; c<sparkles; c++) if (!starv[c]) {
      star[c].style.left=(starx[c]=x)+"px";
      star[c].style.top=(stary[c]=y)+"px";
      star[c].style.clip="rect(0px, 5px, 5px, 0px)";
      star[c].style.visibility="visible";
      starv[c]=50;
      break;
    }
  }
  for (c=0; c<sparkles; c++) {
    if (starv[c]) update_star(c);
    if (tinyv[c]) update_tiny(c);
  }
  setTimeout("sparkle()", 40);
}

function update_star(i) {
  if (--starv[i]==25) star[i].style.clip="rect(1px, 4px, 4px, 1px)";
  if (starv[i]) {
    stary[i]+=1+Math.random()*3;
    if (stary[i]<shigh+sdown) {
      star[i].style.top=stary[i]+"px";
      starx[i]+=(i%5-2)/5;
      star[i].style.left=starx[i]+"px";
    }
    else {
      star[i].style.visibility="hidden";
      starv[i]=0;
      return;
    }
  }
  else {
    tinyv[i]=50;
    tiny[i].style.top=(tinyy[i]=stary[i])+"px";
    tiny[i].style.left=(tinyx[i]=starx[i])+"px";
    tiny[i].style.width="2px";
    tiny[i].style.height="2px";
    star[i].style.visibility="hidden";
    tiny[i].style.visibility="visible"
  }
}

function update_tiny(i) {
  if (--tinyv[i]==25) {
    tiny[i].style.width="1px";
    tiny[i].style.height="1px";
  }
  if (tinyv[i]) {
    tinyy[i]+=1+Math.random()*3;
    if (tinyy[i]<shigh+sdown) {
      tiny[i].style.top=tinyy[i]+"px";
      tinyx[i]+=(i%5-2)/5;
      tiny[i].style.left=tinyx[i]+"px";
    }
    else {
      tiny[i].style.visibility="hidden";
      tinyv[i]=0;
      return;
    }
  }
  else tiny[i].style.visibility="hidden";
}

document.onmousemove=mouse;
function mouse(e) {
  set_scroll();
  y=(e)?e.pageY:event.y+sdown;
  x=(e)?e.pageX:event.x+sleft;
}

function set_scroll() {
  if (typeof(self.pageYOffset)=="number") {
    sdown=self.pageYOffset;
    sleft=self.pageXOffset;
  }
  else if (document.body.scrollTop || document.body.scrollLeft) {
    sdown=document.body.scrollTop;
    sleft=document.body.scrollLeft;
  }
  else if (document.documentElement && (document.documentElement.scrollTop || document.documentElement.scrollLeft)) {
    sleft=document.documentElement.scrollLeft;
	sdown=document.documentElement.scrollTop;
  }
  else {
    sdown=0;
    sleft=0;
  }
}

window.onresize=set_width;
function set_width() {
  if (typeof(self.innerWidth)=="number") {
    swide=self.innerWidth;
    shigh=self.innerHeight;
  }
  else if (document.documentElement && document.documentElement.clientWidth) {
    swide=document.documentElement.clientWidth;
    shigh=document.documentElement.clientHeight;
  }
  else if (document.body.clientWidth) {
    swide=document.body.clientWidth;
    shigh=document.body.clientHeight;
  }
}

function createDiv(height, width) {
  var div=document.createElement("div");
  div.style.position="absolute";
  div.style.height=height+"px";
  div.style.width=width+"px";
  div.style.overflow="hidden";
  div.style.backgroundColor=colour;
  return (div);
}

</script>
<!-- Kaliteli Kod Yayıncısı & Kaynak : http://www.webkodu.com -->
<!-- WebKodu.com / Artık Herşey Tek Çatı Altında : http://www.webkodu.com -->


</head>
<body class="page page-id-1671 page-template-default wpb-js-composer js-comp-ver-4.11.2.1 vc_responsive">
<div id="main_wrapper">

    <!-- NAVBAR
    ================================================== -->
      <div class="navbar-wrapper ">

       <div class="navbar navbar-inverse navbar-static-top container" role="navigation">
       	<div class="logo col-lg-4 col-md-3">
            		<a class="brand" href="#"> <img src="https://i.hizliresim.com/ZXZ0ag.png" alt="craft.tc"  /> </a>
          		</div>
			 
            <div class="navbar-collapse ">
                                            	
<!-- UberMenu [Configuration:main] [Theme Loc:header-menu] [Integration:api] -->
<a class="ubermenu-responsive-toggle ubermenu-responsive-toggle-main ubermenu-skin-clean-white ubermenu-loc-header-menu ubermenu-responsive-toggle-content-align-left ubermenu-responsive-toggle-align-full " data-ubermenu-target="ubermenu-main-76-header-menu">
	<i class="fa fa-bars"></i>Menu
</a>
<nav id="ubermenu-main-76-header-menu" class="ubermenu ubermenu-nojs ubermenu-main ubermenu-menu-76 ubermenu-loc-header-menu ubermenu-responsive ubermenu-responsive-default ubermenu-responsive-collapse ubermenu-horizontal ubermenu-transition-shift ubermenu-trigger-hover_intent ubermenu-skin-clean-white  ubermenu-bar-align-right ubermenu-items-align-left ubermenu-disable-submenu-scroll ubermenu-sub-indicators ubermenu-retractors-responsive">
	<ul id="ubermenu-nav-main-76-header-menu" class="ubermenu-nav">
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="index.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">AnaSayfa</span>
				<span>Haberler..</span>
			</a>
		</li>
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="/kayitol.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">Kaydol</span>
				<span>Aramıza Katıl..</span>
			</a>
		</li>
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="/girisyap.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">Giriş Yap</span>
				<span>Profiline Gir..</span>
			</a>
		</li>
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="/market.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">Market</span>
				<span>Market..</span>
			</a>
		</li>
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="/market.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">Destek</span>
				<span>Yardım Edelim..</span>
			</a>
		</li>
		<li id="menu-item-2339" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-3068 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto" >
			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" title="AnaSayfa" href="/indir.php" tabindex="0">
				<span class="ubermenu-target-title ubermenu-target-text">İndir</span>
				<span>Oyunu İndir..</span>
			</a>
		</li>
	</ul>
</nav>
<!-- End UberMenu -->
			  
                
                             </div><!--/.nav-collapse -->

          </div><!-- /.navbar-inner -->

    </div>

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
<div class="title_wrapper container">


            <div class="col-lg-12">
            	            <h1>İndex Bölümünden Değiştirebilirsiniz<h2><center>Alt Tarafı Da</center></h2></h1>
            </div>
		
            <div class="col-lg-12 breadcrumbs"><strong  >server ip </strong></div>

        <div class="clear"></div>
</div>




        <div class="after-nav ">
        	<div class="container">
                <div class="ticker-title"><i class="fa fa-bullhorn"></i> &nbsp;DUYURULAR</div>
                              <ul id="webticker" >
							                                   <li id='item'>
                               	         <a href="/index.php" class="ticker_cat" style="background-color: #e0043f !important" >Duyuru!</a>
										<a href="/index.php">İndexden Değiştirebilirsiniz</a>
									</li>
							                                   <li id='item'>
                               	         <a href="/index.php" class="ticker_cat" style="background-color: #e0043f !important" >Duyuru!</a>
										<a href="/index.php">deneme123</a>
									</li>
							                              </ul>

            </div>
        </div>


<div class="page normal-page">
     <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
				<div class="vc_row wpb_row vc_row-fluid">
					<div class="wpb_column vc_column_container vc_col-sm-8">
						<div class="vc_column-inner ">
							<div class="wpb_wrapper">
								<div class="wpb_text_column wpb_content_element ">
									<div class="wpb_wrapper">										<div class="title-wrapper">
											<h3 class="widget-title" style="border-color: "><i class="fa fa-newspaper-o"></i> KAYIT OL</h3>
											<div class="clear"></div>
										</div>
										
										<!-- POST -->

													<form method="post" action="">
		<div id="content">
		<br>
		<strong>Kullanıcı adı</strong>
		<header>
		<input type="text" minlength="4" maxlength="16" type="text" name="kadi" /><br />
		<header>
		<br>
		<strong>Şifre</strong> 
		<header>
		<input type="password" minlength="4" maxlength="16" type="text" name="sifre" />
		<header>
		<input type="submit" value="Tıkla, kayıt ol" style="margin-top: 15px">
		<br><br>
		</div>
	</form>
									<!-- POST BİTİŞ -->
									
									<div class="clear"></div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="wpb_column vc_column_container vc_col-sm-4">
					<div class="vc_column-inner ">
						<div class="wpb_wrapper">
							<div class="wpb_widgetised_column wpb_content_element">
								<div class="wpb_wrapper">
									<div class="widget-1 first widget">
										<div class="title-wrapper"> 
											<h3 class="widget-title"><i class="fa fa-newspaper-o"></i> Giriş Yap</h3>
											<div class="clear"></div>
										</div>
										<div class="textwidget">
											<form id="commentform" action="" method="post" class="contact comment-form">
												  <div id="form-section-author" class="form-section input-prepend">
														<input id="author" name="post_oyuncu" placeholder="Kullanıcı Adınız.." type="text" value="" size="30" maxlength="20" tabindex="3">
												  </div>
												  <div id="form-section-author" class="form-section input-prepend">
													 <input placeholder="Şifreniz.." id="password" name="post_sifre" type="password" value="" size="30" maxlength="50" tabindex="4">
												  </div>
												 <div class="form-submit">
													<input id="submit" name="giris-yaptir" class="button-large button-green" type="submit" style="width:100%;" value="Giriş Yap" tabindex="7">
												</div>
											</form>
											<a href="kayitol.php">
												<input id="submit" name="submit" class="button-large button-green" type="submit" style="width:100%;" value="Kayıt Ol" tabindex="7">
											</a>
										</div>
									</div>  
																			<div class="widget-2 widget">
										<div class="title-wrapper"> 
											<h3 class="widget-title"><i class="fa fa-newspaper-o"></i> Sunucu Durumu</h3>
											<div class="clear"></div>
										</div>
										<table class="table table-bordered" style="text-align: center; background: #fff; color: #000000;border-bottom:1px solid #fff;">
											<tbody>
											  <tr>
												<td style="text-align:center;">
													<font color="#000000"><i style="margin-top: 5px;" class="fa fa-edit fa-3x"></i></font>
													<font color="#000000" size="3"><div style="margin-top: 5px;"><strong>0</strong></div></font>
													<font color="#000000" size="1"><p style="margin-top: 1px;">Sisteme Kayıtlı Oyuncu</p></font>
												</td>
												<td style="text-align:center;">
													<font color="#000000"><i style="margin-top: 5px;" class="fa fa-users fa-3x"></i></font>
													<font color="#000000" size="3"><div style="margin-top: 5px;"><strong><b id="omax"></b>0<b id="omax2"></b></strong></div></font>
													<font color="#000000" size="1"><p style="margin-top: 1px;">Çevrimiçi Oyuncu</p></font>
												</td>
											  </tr>
											</tbody>
										</table>
									</div>
									 <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Son alınan 3 kredi</h3>
            </div>
            <div class="box-body">

			<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Kredi</center></th>
                  <th><center>Method</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $kredisor=$db->prepare("SELECT * FROM krediler order by id desc limit 0, 3");
				$kredisor->execute();
				while($kredicek=$kredisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kredicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kredicek['username']; ?></center></td>
                  <td><center><?php echo $kredicek['miktar']; ?></center></td>
                  <td><center><?php echo $kredicek['metod']; ?></center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>

            </div>
          </div>	

</div>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Son alınan 3 ürün</h3>
            </div>
            <div class="box-body">

			<table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>İsim</center></th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $urunsor=$db->prepare("SELECT * FROM alinanurun order by urun_id desc limit 0, 3");
				$urunsor->execute();
				while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $uruncek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $uruncek['username']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_isim']; ?> (<?php echo $uruncek['urun_fiyat']; ?>₺)</center></td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>

            </div>
          </div>
        </section>

       </div>
    </section>
  </div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
	<div class="copyright">
		<div class="container">
		<p>© 2019&nbsp; GBF123. || <a href="https://discordapp.com/invite/SU2nv4u" style="color:#505152;"> GBF123 </a></p>
	</div>


    <style>

/* Customs colours for the site
 *
 * Include colours and backgrounds
 *
 * */


/* Primary color */

#buddypress div.item-list-tabs ul li:hover a, #buddypress div.item-list-tabs ul li.current a, #buddypress div.item-list-tabs ul li.selected a, body.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, body .woocommerce .price_slider_amount button.button, .latest-twitter-tweet .fa-twitter, .woocommerce .products .star-rating, .woocommerce ul.products li.product:hover h3, .ui-state-active a, .nav-tabs a:hover, .nav-tabs>li.active>a, .splitter li a:hover, .splitter li[class*=selected]>a, .post-pinfo a:hover,  .bbp-forum-content ul.sticky .fa-comment, .bbp-topics ul.sticky .fa-comment, .bbp-topics ul.super-sticky .fa-comment, .bbp-topics-front ul.super-sticky .fa-comment, #buddypress .activity-list li.load-more a, body .vc_carousel.vc_per-view-more .vc_carousel-slideline .vc_carousel-slideline-inner > .vc_item > .vc_inner h2 a:hover,
#bbpress-forums fieldset.bbp-form legend, .newsbv li:hover a, .cart-notification span.item-name, .woocommerce div.product p.price, .price span.amount,
.woocommerce .widget_shopping_cart .total span, .nm-date span, .cart-notification span.item-name, .woocommerce div.product p.price, .price span.amount,
.dropdown:hover .dropdown-menu li > a:hover, .clan-generali .clan-members-app > .fa,
.nextmatch_wrap:hover .nm-clans span, input[type="password"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="date"]:focus,
input[type="month"]:focus, input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus,
input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus, .uneditable-input:focus{
	color:#25c2f5 !important;
}

.single-product.woocommerce .single_add_to_cart_button, .after-nav, .gallery-item a img, .match-map .map-image img, .nextmatch_wrap:hover img, .wrap:hover .clan1img, .matchimages img, .dropdown-menu, .widget .clanwar-list > li:first-child, .footer_widget .clanwar-list > li:first-child{
	border-color:#25c2f5 !important;
}

.comment-wrap .com_details a, #buddypress div.item-list-tabs ul li a span, .widget.clanwarlist-page .clanwar-list .date strong,
 .footer_widget.clanwarlist-page .clanwar-list .date strong, #matches .mminfo span,
  .footer_widget .clanwar-list .home-team, .footer_widget .clanwar-list .vs,
   .footer_widget .clanwar-list .opponent-team, .widget .clanwar-list .home-team,
   .widget .clanwar-list .vs, .widget .clanwar-list .opponent-team, div.bbp-template-notice,
   div.indicator-hint, .social a , .widget-title i, .profile-clans a:hover,
   .friendswrapper .friends-count i, .slider_com_wrap, .portfolio .row .span8 .plove a:hover,
   .span3 .plove a:hover, .icons-block i:hover,
   .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:focus, .navbar-inverse .navbar-nav>.active>a:focus>em, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:hover>em, .navbar-inverse .navbar-nav>.active>a>em, .navbar-inverse .navbar-nav>li>a:focus,
   .navbar-inverse .navbar-nav>li>a:focus>em, .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav>li>a:hover>em,
 .similar-projects ul li h3,
 .member h3, .main-colour,a, .dropdown-menu li > a:hover, .wallnav i,  div.rating:after, footer .copyright .social a:hover, .navbar-inverse .brand:hover, .member:hover > .member-social a, footer ul li a:hover, .widget ul li a:hover, .next_slide_text .fa-bolt ,
  .dropdown-menu li > a:focus, .dropdown-submenu:hover > a,
  .comment-body .comment-author,  .navigation a:hover, .cart-wrap a, .bx-next-out:hover .next-arrow:before, body .navbar-wrapper .login-info .login-btn{
    color:#25c2f5;
}

#sform input[type=search], .ubermenu .wpcf7-submit:hover, body .ubermenu-skin-clean-white .ubermenu-item-level-0:hover > .ubermenu-target, body .ubermenu-skin-clean-white .ubermenu-item-level-0.ubermenu-active > .ubermenu-target,
body .flex-control-paging li a.flex-active, body .flex-control-paging li a:hover, body .wpb_posts_slider .flex-caption h2 a, .navbar-inverse .nav>li.active>a, .navbar-inverse .nav>li.current-menu-item>a, .navbar-inverse .nav>li>a:hover, .navbar .nav li.current-menu-parent a, .navbar .nav li.current_page_item a,
.button-big:hover, .button-medium:hover, .button-small:hover, button[type=submit]:hover, input[type=button]:hover, input[type=submit]:hover, .navbar-nav>li:after, .ticker-title, .after-nav .container:before, div.pagination a:focus, div.pagination a:hover, div.pagination span.current, .page-numbers:focus, .page-numbers:hover, .page-numbers.current, body.woocommerce nav.woocommerce-pagination ul li a:focus, body.woocommerce nav.woocommerce-pagination ul li a:hover, body.woocommerce nav.woocommerce-pagination ul li span.current, .widget .clanwar-list .tabs li:hover a, .widget .clanwar-list .tabs li.selected a, .bgpattern, .post-review, .widget_shopping_cart, .woocommerce .cart-notification, .cart-notification, .splitter li[class*="selected"] > a, .splitter li a:hover, .ls-wp-container .ls-nav-prev, .ls-wp-container .ls-nav-next, a.ui-accordion-header-active, .accordion-heading:hover, .block_accordion_wrapper .ui-state-hover, .cart-wrap, .clanwar-list li ul.tabs li:hover, .clanwar-list li ul.tabs li.selected a:hover, .clanwar-list li ul.tabs li.selected a, .dropdown .caret,
.tagcloud a:hover, .progress-striped .bar ,  .bgpattern:hover > .icon, .progress-striped .bar, .member:hover > .bline, .blog-date span.date,
 .pbg, .pbg:hover, .pimage:hover > .pbg, ul.social-media li a:hover, .navigation a ,
 .pagination ul > .active > a, .pagination ul > .active > span, .list_carousel a.prev:hover, .list_carousel a.next:hover, .pricetable .pricetable-col.featured .pt-price, .block_toggle .open, .pricetable .pricetable-featured .pt-price, .isotopeMenu, .bbp-topic-title h3, .modal-body .reg-btn, #LoginWithAjax_SubmitButton .reg-btn, .footer_widget h3, buddypress div.item-list-tabs ul li.selected a, .results-main-bg, .blog-date-noimg, .blog-date, .ticker-wrapper.has-js, .ticker-swipe  {
    background-color:#25c2f5;
}


body .woocommerce .price_slider_amount button.button:hover{
	background-color:#25c2f5 !important;
}
.button-medium, .button-small, .button-big, button[type="submit"], input[type="submit"]{
	color:#25c2f5;
}
.ticker-title:before{
	border-bottom: 38px solid #25c2f5;
}


.next-arrow{
	border-left: 30px solid ;
}
body .woocommerce .price_slider_amount button.button, .single-product.woocommerce div.product form.cart .button.single_add_to_cart_button, input[type=password]:active, input[type=password]:focus, input[type=password]:hover, input[type=text]:active, input[type=text]:focus, input[type=text]:hover,  select:active, select:focus, select:hover, textarea:active, textarea:focus, textarea:hover,
.page-numbers,  div.bbp-template-notice, div.indicator-hint,  div.pagination a, div.pagination span,body.woocommerce nav.woocommerce-pagination ul li a, body.woocommerce nav.woocommerce-pagination ul li span{
	border: 1px solid #25c2f5 !important;
}
.single-product.woocommerce div.product form.cart .button.single_add_to_cart_button, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a {
	background: #25c2f5  !important;
}
.woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce-message, .woocommerce-error, .woocommerce-info, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-range{
	background:#25c2f5 !important;
}
.button-medium, .button-small, .button-big, button[type="submit"], input[type="submit"],
textarea:focus,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="datetime"]:focus,
input[type="datetime-local"]:focus,
input[type="date"]:focus,
input[type="month"]:focus,
input[type="time"]:focus,
input[type="week"]:focus,
input[type="number"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="search"]:focus,
input[type="tel"]:focus,
input[type="color"]:focus,
.uneditable-input:focus,
.gallery-item a img:hover,
h3.widget-title{
	border-color:#25c2f5;
}

/* Background Tint */


	#main_wrapper, .owl-item .car_image:after, .newsb-thumbnail a:after, .ins_widget ul li a:after, .blog-image a:after{
		background: url(content/themes/oguzhanpw/img/pattern.png) top left repeat rgba(0,156,255,0.4);
	}


/* Secondary Color */

.wpb_wrapper > div:nth-child(2n) h3.widget-title {
    border-color: #ed084d;
}

.wpb_wrapper .widget:nth-child(2n) h3.widget-title {
    border-color: #ed084d;
}

body .ubermenu-skin-clean-white .ubermenu-item-level-0.ubermenu-current-menu-item > .ubermenu-target,
body .ubermenu-skin-clean-white .ubermenu-item-level-0.ubermenu-current-menu-parent > .ubermenu-target,
body .ubermenu-skin-clean-white .ubermenu-item-level-0.ubermenu-current-menu-ancestor > .ubermenu-target,
body .ubermenu-skin-clean-white .ubermenu-submenu .ubermenu-current-menu-item > .ubermenu-target,
body .ubermenu-skin-clean-white .ubermenu-item-level-0 > .ubermenu-target{
	color: #ed084d;
}

/* Other color fixes */


.navbar-wrapper .login-info .login-btn .fa,
.clanwar-list .upcoming, #matches ul.cmatchesw li .deletematch, .friendswrapper .add-friend, .msg_ntf,
.footer_widget .clanwar-list .scores, .widget .clanwar-list .scores, .user-avatar, .woocommerce-page .product-wrap a.button,
.footer_widget .clanwar-list .upcoming, .widget .clanwar-list .upcoming, .user-wrap a.btns, .cart-outer,
.footer_widget .clanwar-list .playing, .widget .clanwar-list .playing, .pricetable .pricetable-col.featured .pt-top, .pricetable .pricetable-featured .pt-top,
.after-nav .login-tag, .next-line, .bx-wrapper .bx-pager.bx-default-pager a:hover:before,
.bx-wrapper .bx-pager.bx-default-pager a.active:before, .after-nav .login-info a, .clan-page .clan-nav li, .wpb_tabs_nav li,
 #buddypress div.item-list-tabs ul li,
 .blog-date span.date, .blog-date-noimg span.date, .clanwar-list .draw, .carousel-indicators .active, .after-nav .login-info input[type="submit"], .after-nav .login-info a:hover{
	background-color:#25c2f5;
}

.slider_com_wrap *{
	color: !important;
}


.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce table.cart td.actions .button.checkout-button, .button-medium:after, .button-small:after, .button-big:after, button[type="submit"]:after, input[type="submit"]:after {
	opacity:0.8;
}


.woocommerce .product-wrap .add_to_cart_button.added, .woocommerce .product-wrap .add_to_cart_button.added:hover {
	opacity:0.8;
}

div.bbp-template-notice, div.indicator-hint{
	background:rgba(0,156,255,0.1);
}

#bbpress-forums li.bbp-header, #bbpress-forums fieldset.bbp-form legend, .bbp-topic-title h3, .bbp-topics-front ul.super-sticky i.icon-comment,
.bbp-topics ul.super-sticky i.icon-comment,
.bbp-topics ul.sticky i.icon-comment,
.bbp-forum-content ul.sticky i.icon-comment,
.header-colour{
/color:;
}
html{
	background-color:#1d2031;
}


<li style="background-image:url(); ">
body{
      /*  background-attachment: fixed !important; */
	    background:url('http://mc.tc/backgroundlib/background(10).gif') no-repeat center center fixed;
	 -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
body .blog, body .normal-page, body .portfolio{
    margin-bottom: -15px;
}
.logo img{
	margin-top:10px;
}
</style>	
<script type='text/javascript' src='https://kola2.craft.tc/content/themes/oguzhanpw/js/jquery.webticker.js'></script>
<script type='text/javascript' src='https://kola2.craft.tc/content/themes/oguzhanpw/js/global.js'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var ubermenu_data = {"remove_conflicts":"on","reposition_on_load":"off","intent_delay":"300","intent_interval":"100","intent_threshold":"7","scrollto_offset":"50","scrollto_duration":"1000","responsive_breakpoint":"959","accessible":"on","retractor_display_strategy":"responsive","touch_off_close":"on","collapse_after_scroll":"on","v":"3.2.4","configurations":["main"],"ajax_url":"","plugin_url":"ubermenu/"};
/* ]]> */
</script>
<script type='text/javascript' src='https://kola2.craft.tc/content/plugins/ubermenu/assets/js/ubermenu.min.js'></script>
</body>
</html>