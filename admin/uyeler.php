<?php include 'head.php'; 
	  include 'sidebar.php';

if (isset($_POST['ksil'])) {

	$sil=$db->prepare("DELETE from authme where id=:id");
	$kontrol=$sil->execute(array('id' => $_POST['kid']));
	if ($kontrol) {
		header("refresh: 0; url=uyeler.php");
	} else {
		echo "<script>alert('Kullanıcı silinemedi')</script>";
		header("refresh: 0; url=uyeler.php");
	}
}
if ($_GET['yetkid']=="ok") {

	
	$duzenle=$db->prepare("UPDATE authme SET yetki=:yetki WHERE id=:id");
	$update=$duzenle->execute(array('yetki' => $_GET['yetki'], 'id' => $_GET['id']));

	if ($update) {
		echo "<script>alert('Kullanıcının başarıyla yetkisi değiştirildi')</script>";
		header("refresh: 0; url=uyeler.php");
	} else {
		echo "<script>alert('Kullanıcının yetkisi değiştirilemedi')</script>";
		header("refresh: 0; url=uyeler.php");
	}

}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
    	<br>
      <div class="row">

        <section class="col-md-12">
        <div class="col-lg-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Üyeler</h3>
              <a href="uye-ekle.php"><button type="submit" name="kekle" class="btn btn-success pull-right">Ekle</button></a>
            </div>

            <div class="box-body">
			  <table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th>#</th>
                  <th><center>Kullanıcı adı</center></th>
                  <th><center>Kredi</center></th>
                  <th><center>Yetki</center></th>
                  <th>İşlemler</th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $kullanicisor=$db->prepare("SELECT * FROM authme order by yetki DESC");
				$kullanicisor->execute();
				while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><img style="border: 0px solid; border-radius: 4px;" src="https://cravatar.eu/avatar/<?php echo $kullanicicek['username']; ?>/24.png"></center></td>
                  <td><center><?php echo $kullanicicek['username']; ?></center></td>
                  <td><center><?php echo $kullanicicek['kredi']; ?></center></td>
                  <td><center><?php if ($kullanicicek['yetki']) { echo "Admin"; }else{ echo "Üye"; } ?></center></td>
                  <td>
                  	<a href="uye-duzenle.php?id=<?php echo $kullanicicek['id']; ?>"><button type="button" class="btn btn-xs btn-primary">Düzenle</button></a>
                  	<?php if ($kullanicicek['yetki']) {?>

                  	<a href="uyeler.php?id=<?php echo $kullanicicek['id'] ?>&yetki=0&yetkid=ok"><button class="btn btn-xs btn-warning">Üye yap</button></a>

                  	<?php }else{ ?>

					<a href="uyeler.php?id=<?php echo $kullanicicek['id'] ?>&yetki=1&yetkid=ok"><button class="btn btn-xs btn-success">Admin yap</button></a>

					<?php } ?>
					<form method="POST">
						<input type="hidden" name="kid" value="<?php echo $kullanicicek['id']; ?>">
						<button type="submit" name="ksil" class="btn btn-xs btn-danger" onclick="return ShowConfirm();">Sil</button>
                  	</form>
                  </td>
                </tr>

            	<?php } ?>

                </tbody>
              </table>
            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>