<?php include 'head.php'; 
	  include 'sidebar.php';

$urunsor=$db->prepare("SELECT * FROM urunler where urun_id=:urun_id");
$urunsor->execute(array('urun_id' => $_GET['id']));
$say=$urunsor->rowCount();
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['ukaydet'])) {

  $urunkaydet=$db->prepare("UPDATE urunler SET
    urun_isim=:urun_isim,
    urun_resimurl=:urun_resimurl,
    urun_fiyat=:urun_fiyat,
    urun_komut=:urun_komut
    WHERE urun_id=:urun_id");

  $update=$urunkaydet->execute(array(
    'urun_isim' => $_POST['urun_isim'],
    'urun_resimurl' => $_POST['urun_resimurl'],
    'urun_fiyat' => $_POST['urun_fiyat'],
    'urun_komut' => $_POST['urun_komut'],
    'urun_id' => $_POST['urun_id']));


  if ($update) {
  	echo "<script>alert('Ürün bilgileri değiştirildi')</script>";
    header("refresh: 0; url=urunler.php");

  } else {
  	echo "<script>alert('Ürün bilgileri değiştirilemedi')</script>";
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
              <h3 class="box-title">Ürün Düzenle</h3>
            </div>

            <div class="box-body">
              <center>
              <form method="POST">
                <div class="form-group">
                  <label>Ürün adı</label>
                  <input type="text" style="width: 200px" name="urun_isim" class="form-control" value="<?php echo $uruncek['urun_isim']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Fiyat</label>
                  <input type="number" style="width: 200px" name="urun_fiyat" min="0" max="250" value="<?php echo $uruncek['urun_fiyat']; ?>" class="form-control">
                </div>

                <div class="form-group">
                  <label>Komut</label>
                  <input type="text" style="width: 200px" name="urun_komut" class="form-control" value="<?php echo $uruncek['urun_komut']; ?>" required="required">
                </div>

                <div class="form-group">
                  <label>Resim Url</label>
                  <input type="text" style="width: 200px" name="urun_resimurl" class="form-control" value="<?php echo $uruncek['urun_resimurl']; ?>">
                </div>

                <input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
                <button type="submit" name="ukaydet" class="btn btn-primary">Kaydet</button>
              </form>
              </center>
            </div>

          </div>

        </div>

        </section>
      </div>

    </section>
  </div>
  <?php include 'footer.php'; ?>