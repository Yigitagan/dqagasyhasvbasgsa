<?php include 'head.php'; 
	  include 'sidebar.php';

if (isset($_POST['usil'])) {

	$sil=$db->prepare("DELETE from urunler where urun_id=:id");
	$kontrol=$sil->execute(array('id' => $_POST['uid']));
	if ($kontrol) {
		header("refresh: 0; url=urunler.php");
	} else {
		echo "<script>alert('Ürün silinemedi')</script>";
		header("refresh: 0; url=urunler.php");
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
              <h3 class="box-title">Ürünler</h3>
              <a href="urun-ekle.php"><button type="submit" name="kekle" class="btn btn-success pull-right">Ekle</button></a>
            </div>

            <div class="box-body">
			  <table id="example2" class="table table-bordered table-hover">
                <thead>

                <tr>
                  <th><center>Ürün Adı</center></th>
                  <th><center>Fiyat</center></th>
                  <th><center>Komut</center></th>
                  <th><center>Resim Url</center></th>
                  <th>İşlemler</th>
                </tr>

                </thead>
                <tbody>

                <?php 
                $urunsor=$db->prepare("SELECT * FROM urunler order by urun_isim DESC");
				        $urunsor->execute();
				        while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                <tr>
                  <td><center><?php echo $uruncek['urun_isim']; ?></center></td>
                  <td><center><?php echo $uruncek['urun_fiyat']; ?></center></td>
                  <td><?php echo $uruncek['urun_komut']; ?></td>
                  <td><center><img src="<?php
                  if( $uruncek['urun_resimurl'] != null){
                    echo "../".$uruncek['urun_resimurl']; 
                    }else{
                      echo "../img/urunbos.jpg";
                    }?>" width="15%"></center></td>
                  <td><a href="urun-duzenle.php?id=<?php echo $uruncek['urun_id']; ?>"><button type="button" class="btn btn-xs btn-primary">Düzenle</button></a>
					<form method="POST">
						<input type="hidden" name="uid" value="<?php echo $uruncek['urun_id']; ?>">
						<button type="submit" name="usil" class="btn btn-xs btn-danger" onclick="return ShowConfirm();">Sil</button>
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